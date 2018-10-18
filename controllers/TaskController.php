<?php

namespace app\controllers;

use Yii;
use app\models\Task;
use app\models\TaskSearch;
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
//    return $this->render('index', ['models' => Task::getTaskAll()]);
    $dataProvider = (new TaskSearch())->search(Yii::$app->request->queryParams);
    
    return $this->render('index', [
      'dataProvider' => $dataProvider
    ]);
  }
  
  public function actionView($id) {
    $model = Task::getTask($id);
    return $this->render('view', [
      'model' => $model
    ]);
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
}