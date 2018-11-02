<?php

namespace app\commands;


use app\models\tables\Users;
use yii\console\Controller;
use yii\db\ActiveQuery;
use yii\helpers\Console;

class TaskController extends Controller
{
    public function actionDeadline($pause = 1) {
        $users = Users::find()
            ->leftJoin('tasks', '`tasks`.`user_id` = `users`.`id`')
            ->where(['and', 'tasks.date > now()', 'tasks.date < adddate(now(), INTERVAL 1 DAY)'])
            ->with([
                'tasks' => function ($query) {
                    /* @var $query ActiveQuery */
                    $query->andWhere(['and', 'tasks.date > now()', 'tasks.date < adddate(now(), INTERVAL 1 DAY)']);
                }
            ])
            //->limit(1)
            ->all();
        
        Console::startProgress(1, count($users));
        $i = 1;
        foreach ($users as $user) {
            \Yii::$app->mailer->compose('task/deadline', ['user' => $user])
                ->setFrom([\Yii::$app->params['adminEmail'] => 'Admin'])
                ->setTo($user->email)
                ->setSubject('Задачи на завтра')
                ->send();
            
            Console::updateProgress($i++, count($users));
            sleep($pause);
        }
        Console::endProgress(0);
        
        /*$data = (new Query())
            ->select(['u.id', 'u.username', "CONCAT(u.first_name, ' ', u.last_name) AS name", 'u.email', 't.title'])
            ->from(['u' => 'users'])
            ->leftJoin(['t' => 'tasks'], 't.user_id = u.id')
            ->where(['and', 't.date > now()', 't.date < adddate(now(), INTERVAL 1 DAY)'])
            ->all();
        
        var_dump($data);*/
        
    }
}