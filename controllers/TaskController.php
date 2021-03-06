<?php

namespace app\controllers;


use app\models\tables\Users;
use app\models\Task;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\searchModels\TaskSearch;
use app\models\tables\Tasks;
use app\models\Image;
use yii\web\UploadedFile;


class TaskController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete', 'add-image', 'delete-image'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'roles' => ['createTask'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['update'],
                        'roles' => ['updateTask'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['delete'],
                        'roles' => ['deleteTask'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['add-image'],
                        'roles' => ['@'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['delete-image'],
                        'roles' => ['productManager'],
                        'verbs' => ['POST'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex() {
        $searchModel = new TaskSearch(['pageSize' => 10]);
        $searchModel->setAttribute('date', date('Y-m'));
        $dataProvider = $searchModel->search(null);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }
    
    public function actionView($id) {
        $model = Tasks::findOne($id);
        $imageModel = new Image();
        $dataProvider = Image::getDataProvider($id);
        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'imageModel' => $imageModel,
        ]);
    }
    
    public function actionCreate() {
        $model = new Task();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'users' => Users::getArrAllUsers(),
        ]);
    }
    
    public function actionUpdate($id) {
        $model = Task::getOne($id);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            'users' => Users::getArrAllUsers(),
        ]);
    }
    
    public function actionDelete($id) {
        Tasks::findOne($id)->delete();
        return $this->redirect(['index']);
    }
    
    public function actionAddImage($id) {
        if (\Yii::$app->request->isPost) {
            $imageModel = new Image();
            $imageModel->image = UploadedFile::getInstance($imageModel, 'image');
            $imageModel->upload($id);
        }
        return $this->redirect(['view', 'id' => $id]);
    }
    
    public function actionDeleteImage($imgId, $taskId) {
        Image::findOne($imgId)->delete();
        return $this->redirect(['view', 'id' => $taskId]);
    }
    
    
}