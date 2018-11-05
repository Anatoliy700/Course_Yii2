<?php

namespace app\modules\lk;

use yii\filters\AccessControl;

/**
 * lk module definition class
 */
class Lk extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\lk\controllers';
    public $defaultRoute = 'lk';
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
        ];
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function init() {
        parent::init();
        
        // custom initialization code goes here
    }
}
