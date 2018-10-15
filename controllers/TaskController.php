<?php

namespace app\controllers;

use app\models\tables\Users;
use app\models\Task;
use yii\web\Controller;

class TaskController extends Controller
{
  public function init() {
    if (\Yii::$app->user->isGuest) {
      $this->redirect('index.php?r=site/login');
    }
    parent::init();
  }
  
  public function actionIndex() {
    return $this->render('index', ['models' => Task::getTaskAll()]);
    
  }
  
  public function actionAdd() {
    $model = new Task();
    if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
      $model->save();
      $this->redirect('index.php?r=task');
    }
    $message = 'Довивить задание';
    return $this->render('add', [
      'message' => $message,
      'model' => $model
    ]);
  }
  
  public function actionTest() {
    /*    $user = new Users();
        $user->username = 'admin';
        $user->password = md5('admin');
        $user->first_name = 'Иван';
        $user->last_name = 'Иванов';
        $user->role_id = '1';
        $user->save();*/
    
    $user = Users::findOne(1);
    var_dump($user->role);
  }
}