<?php

namespace app\components\validators;


use yii\validators\StringValidator;

class TaskStringValidator extends StringValidator
{
  
  public $startWord;
  public $pattern;
  public $startWordMessage;
  
  public function init() {
    parent::init();
    if (!is_null($this->startWord)) {
      $this->pattern = "#^{$this->startWord}\s\w+#u";
      $this->startWordMessage = \Yii::t(
        'app',
        '{attribute} должна начинаться со слова «{startWord}» за которым следует название'
      );
    }
  }
  
  public function validateAttribute($model, $attribute) {
    parent::validateAttribute($model, $attribute);
    if (!is_null($this->startWord) && !preg_match($this->pattern, $model->$attribute)) {
      $this->addError($model, $attribute, $this->startWordMessage, ['startWord' => $this->startWord]);
    }
  }
  
}