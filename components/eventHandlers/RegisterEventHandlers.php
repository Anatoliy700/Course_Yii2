<?php

namespace app\components\eventHandlers;

use app\models\tables\Tasks;
use \Yii;
use app\models\tables\Users;
use yii\base\Component;
use yii\base\Event;

class RegisterEventHandlers extends Component
{
    
    public function init() {
        parent::init();
        $this->sendMailAtRegisterUser();
        $this->sendMailAtCreateTask();
    }
    
    
    public function sendMailAtRegisterUser() {
        
        Event::on(Users::class, Users::EVENT_AFTER_INSERT, function ($event) {
            $data['email'] = $event->sender->email;
            $data['from'] = [Yii::$app->params['adminEmail'] => 'Админ'];
            $data['subject'] = 'Вы успешно зарегистррованы';
            $data['message'] = "Поздравляем, {$event->sender->first_name}
                                {$event->sender->last_name} с успешной регистрацией";
            $this->sendMail($data);
        });
    }
    
    public function sendMailAtCreateTask() {
        Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, function ($event) {
            $user = Users::findOne($event->sender->user_id);
            $data['email'] = $user->email;
            $data['from'] = [Yii::$app->params['adminEmail'] => 'Админ'];
            $data['subject'] = 'Новая задача';
            $data['message'] = "{$user->first_name} {$user->last_name},
                                Вам поставлена задача {$event->sender->title}";
            $this->sendMail($data);
        });
    }
    
    public function sendMail($data) {
        
        Yii::$app->mailer->compose()
            ->setTo($data['email'])
            ->setFrom($data['from'])
            ->setSubject($data['subject'])
            ->setTextBody($data['message'])
            ->send();
    }
}