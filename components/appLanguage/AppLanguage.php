<?php

namespace app\components\appLanguage;


use yii\base\Component;

class AppLanguage extends Component
{
    protected $appLanguage;
    protected $session;
    public $sessionName = 'language';
    public $localeNames = [
        'en' => 'en-US',
        'ru' => 'ru-RU',
    ];
    
    public function init() {
        parent::init();
        $this->appLanguage = &\Yii::$app->language;
        $this->session = \Yii::$app->session;
        if (isset($this->session[$this->sessionName])){
            $this->appLanguage = $this->session[$this->sessionName];
        } else {
            $this->session[$this->sessionName] = $this->appLanguage;
        }
    }
    
    public function set($lng){
        $this->session[$this->sessionName] = $this->localeNames[$lng];
        $this->appLanguage = $this->localeNames[$lng];
    }
}