<?php

/* @var $dataProvider \yii\data\ActiveDataProvider */

/* @var $searchModel \app\modules\lk\models\TaskSearch */

use yii\helpers\Html;

$this->title = 'Мои задачи';
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['/lk']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tasks-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = \yii\widgets\ActiveForm::begin(['method' => 'get']) ?>
    <?= $form->field($searchModel, 'date')->widget(\yii\jui\DatePicker::class, ['dateFormat' => 'yyyy-MM']) ?>
    <?= Html::submitButton('Отфильтровать') ?>
    <?php \yii\widgets\ActiveForm::end() ?>
    
    
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'item',
        'itemOptions' => function ($model) {
            return ['tag' => 'a', 'href' => \yii\helpers\Url::to(['view', 'id' => $model->id])];
        },
    ]) ?>

</div>
