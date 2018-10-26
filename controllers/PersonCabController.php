<?php

namespace app\controllers;

use app\models\searchModels\TaskSearch;
use app\models\tables\Tasks;

class PersonCabController extends \yii\web\Controller
{
    public function behaviors() {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['tasks'],
                'enabled' => true,
                'duration' => 3600,
                'variations' => [
                    \Yii::$app->language,
                    \Yii::$app->request->queryParams,
                ],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'CHECKSUM TABLE tasks',
                ],
            ],
        ];
    }
    
    public function init() {
        if (\Yii::$app->user->isGuest) {
            $this->redirect(['/site/login']);
        }
        parent::init();
    }
    
    public function actionIndex() {
        return $this->render('index', [
            'user' => \Yii::$app->user->identity
        ]);
    }
    
    public function actionTasks() {
        var_dump(\Yii::$app->request->queryParams['page']);
        $searchModel = new TaskSearch(['pageSize' => 10]);
        $searchModel->setAttribute('user_id', \Yii::$app->user->identity->id);
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        
        return $this->render('tasks', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    
    public function actionTaskView($id) {
        $model = Tasks::findOne($id);
        return $this->render('view', [
            'model' => $model
        ]);
    }
    
}
