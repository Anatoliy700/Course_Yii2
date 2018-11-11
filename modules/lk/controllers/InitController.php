<?php

namespace app\modules\lk\controllers;


use yii\web\Controller;

abstract class InitController extends Controller
{
    public function init() {
        if (\Yii::$app->user->isGuest) {
            $this->redirect(['/site/login']);
        }
        parent::init();
    }
}