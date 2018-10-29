<?php

namespace app\models;


use app\models\tables\Images;
use yii\data\ActiveDataProvider;

class Image extends Images
{
    static public function getDataProvider($id){
        return new ActiveDataProvider([
            'query' => Images::find()->where(['task_id' => $id])
        ]);
    }
    
}