<?php

use yii\widgets\DetailView;
use \yii\helpers\Html;

/* @var $model \app\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ["index"]];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="task-wrap">
  <?= Html::tag('h2', $model->title) ?>
  <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
      'date:date',
      'description',
        'username',
        'created_at',
        'updated_at',
    ]
  ]) ?>
</div>

