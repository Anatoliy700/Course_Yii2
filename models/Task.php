<?php

namespace app\models;

use app\models\tables\Tasks;
use Yii;
use yii\base\Model;

class Task extends Model
{
  public $id;
  public $date;
  public $title;
  public $description;
  static protected $taskDbClass = '\app\models\tables\Tasks';
  
  public function rules() {
    return [
      [['id'], 'integer', 'min' => 1],
      [['date', 'title', 'description'], 'required'],
      ['date', 'date', 'format' => 'php:Y-m-d', 'min' => date('Y-m-d'), 'minString' => 'текущей'],
      ['title', 'string', 'length' => [5, 10]],
      //['title', 'app\components\validators\TaskStringValidator', 'length' => [5, 20], 'startWord' => 'Сделать'],
      ['description', 'string', 'min' => 5]
    ];
  }
  
  //TODO: доделать выборку с разными периодами
  static public function getTaskAll() {
    $models = self::$taskDbClass::find()
      ->where(['user_id' => Yii::$app->user->identity->id])
      ->andWhere(['MONTH(date)' => date('m')])
      ->all();
    $tasks = [];
    
    foreach ($models as $model) {
      $task = new self();
      $task->attributes = $model->toArray();
      $tasks[] = $task;
    }
    return $tasks;
  }
  
  static public function getTask($id) {
    return new self(Tasks::findOne($id)->toArray());
  }
  
  public function save() {
    $model = new self::$taskDbClass();
    $model->attributes = $this->toArray();
    $model->user_id = Yii::$app->user->identity->id;
    $model->save();
  }
  
  public function attributeLabels() {
    return [
      'date' => 'Дата',
      'title' => 'Задача',
      'description' => 'Описание'
    ];
  }
}