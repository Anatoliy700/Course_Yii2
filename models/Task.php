<?php

namespace app\models;


use yii\base\Model;

class Task extends Model
{
  public $date;
  public $title;
  public $description;
  
  public function rules() {
    return [
      [['date', 'title', 'description'], 'required'],
      ['date', 'date', 'format' => 'php:Y-m-d', 'min' => date('Y-m-d'), 'minString' => 'текущей'],
      //['title', 'string', 'length' => [5, 10]],
      ['title', 'app\components\validators\TaskStringValidator', 'length' => [5, 20], 'startWord' => 'Сделать'],
      ['description', 'string', 'min' => 5]
    ];
  }
  
  public function attributeLabels() {
    return [
      'date' => 'Дата',
      'title' => 'Задача',
      'description' => 'Описание'
    ];
  }
  
  public function fields() {
    return [
      'Дата' => 'date',
      'Задача' => 'title',
      'Описание' => 'description'
    ];
  }
}