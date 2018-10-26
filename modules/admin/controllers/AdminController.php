<?php

namespace app\modules\admin\controllers;


class AdminController extends InitController
{
    public function actionIndex(){
        return $this->render('index');
    }
}