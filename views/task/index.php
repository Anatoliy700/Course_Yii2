<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $models \app\models\Task */
/* @var $dataProvider  \yii\data\ActiveDataProvider */

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tasks-index">
  <h1><?= Html::encode($this->title) ?></h1>
  
  <?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'taskItem',
    'itemOptions' => function ($model) {
      return ['tag' => 'a', 'href' => Url::to(['view', 'id' => $model->id])];
    },
  ]) ?>

</div>