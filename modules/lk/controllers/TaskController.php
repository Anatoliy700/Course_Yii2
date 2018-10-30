<?php

namespace app\modules\lk\controllers;


use app\modules\lk\models\Image;
use app\modules\lk\models\search\TaskSearch;
use app\models\tables\Tasks;
use yii\helpers\Url;
use yii\web\UploadedFile;


class TaskController extends InitController
{
    public function behaviors() {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'enabled' => true,
                'duration' => 3600,
                'variations' => [
                    \Yii::$app->language,
                    \Yii::$app->request->queryParams,
                    \Yii::$app->user->id,
                ],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'CHECKSUM TABLE tasks',
                ],
            ],
        ];
    }
    
    public function actionIndex() {
        $searchModel = new TaskSearch(['pageSize' => 10]);
        $searchModel->setAttribute('user_id', \Yii::$app->user->identity->id);
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
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
            'taskId' => $id,
        ]);
    }
    
    public function actionAddImage($id) {
        if (\Yii::$app->request->isPost) {
            $imageModel = new Image();
            $imageModel->image = UploadedFile::getInstance($imageModel, 'image');
            $imageModel->upload($id);
        }
        $this->redirect(['view', 'id' => $id]);
    }
    
    
}