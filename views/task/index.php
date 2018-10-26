<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $models \app\models\Task */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Задачи команды на текущий месяц';
?>

<div class="tasks-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'item',
        'itemOptions' => function ($model) {
            return ['tag' => 'a', 'href' => Url::to(['task/view', 'id' => $model->id])];
        },
    ]) ?>

</div>