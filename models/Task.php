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
      ['date', 'date', 'format' => 'php:d.m.Y'],
      ['title', 'string', 'length' => [5, 10]],
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