<?php

namespace app\controllers;


use yii\web\Controller;
use app\models\searchModels\TaskSearch;
use app\models\tables\Tasks;
use app\models\Image;


class TaskController extends Controller
{
    
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
        $dataProvider = Image::getDataProvider($id);
        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
}