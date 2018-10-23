<?php
/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 23.10.2018
 * Time: 13:43
 */

namespace app\components\eventHandlers;

use \Yii;
use app\models\tables\Users;
use yii\base\Event;

class RegisterUser
{
    public function __construct() {
        Event::on(Users::class, Users::EVENT_AFTER_INSERT, [static::class, 'sendMail']);
    }
    
    public function sendMail($event) {
        
        Yii::$app->mailer->compose()
            ->setTo($event->sender->email)
            ->setFrom([Yii::$app->params['adminEmail'] => 'Админ'])
            ->setSubject('Вы успешно зарегистррованы')
            ->setTextBody("Поздравляем, {$event->sender->first_name} {$event->sender->last_name} с успешной регистрацией")
            ->send();
    }
}