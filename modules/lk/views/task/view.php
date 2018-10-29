<?php

use yii\widgets\DetailView;
use \yii\helpers\Html;

/* @var $model \app\models\Task */
/* @var $imageModel \app\modules\lk\models\Image */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['/lk']];
$this->params['breadcrumbs'][] = ['label' => 'Мои задачи', 'url' => ["index"]];
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

<div class="task-images-wrap clearfix">
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'imageItem',
        'summary' => '',
        'emptyText' => false,
    ]) ?>
</div>

<div class="add-image">
    <h3>Добавить изображение</h3>
    <?= $this->render('imageForm', [
        'model' => $imageModel,
    ]) ?>
</div>

