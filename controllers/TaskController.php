<?php

namespace app\controllers;


use app\models\Task;
use yii\web\Controller;

class TaskController extends Controller
{
  public function actionIndex() {
    $model = new Task();
    if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
      return $this->render('info', [
        'message' => 'Ваше задание:',
        'data' => $model->toArray()
      ]);
    }
    $message = 'Довивить задание';
    return $this->render('add', [
      'message' => $message,
      'model' => $model
    ]);
  }
}