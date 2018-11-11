<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\tables\Users;
use app\models\tables\Tasks;
use app\modules\admin\models\Task;
use app\modules\admin\models\search\TaskSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Tasks model.
 */
class TaskController extends AdminController
{
  
  public function init() {
    if (\Yii::$app->user->isGuest) {
      $this->redirect('index.php?r=site/login');
    }
    parent::init();
  }
  
  
  /**
   * {@inheritdoc}
   */
  public function behaviors() {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['POST'],
        ],
      ],
    ];
  }
  
  /**
   * Lists all Tasks models.
   * @return mixed
   */
  public function actionIndex() {
    $searchModel = new TaskSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }
  
  /**
   * Displays a single Tasks model.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id) {
    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }
  
  /**
   * Creates a new Tasks model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate() {
    $model = new Task();
    $users = Users::getArrAllUsers();
    
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }
    
    return $this->render('create', [
      'model' => $model,
      'users' => $users
    ]);
  }
  
  /**
   * Updates an existing Tasks model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id) {
    $model = $this->findModel($id);
    $users = Users::getArrAllUsers();
    
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }
    
    return $this->render('update', [
      'model' => $model,
      'users' => $users
    ]);
  }
  
  /**
   * Deletes an existing Tasks model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id) {
    $this->findModel($id)->delete();
    
    return $this->redirect(['index']);
  }
  
  /**
   * Finds the Tasks model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Tasks the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id) {
    if (($model = Tasks::findOne($id)) !== null) {
      return $model;
    }
    
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
