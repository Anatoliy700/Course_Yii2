<?php

namespace app\modules\lk\controllers;


class LkController extends InitController
{
    
    public function actionIndex() {
        return $this->render('index', [
            'user' => \Yii::$app->user->identity
        ]);
    }
    
    
}
