<?php

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\searchModels\TaskSearch */

use yii\helpers\Html;

$this->title = 'Мои задачи';
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tasks-index">
    <h1><?= \yii\helpers\Html::encode($this->title) ?></h1>
    
    <?php $form = \yii\widgets\ActiveForm::begin(['method' => 'get']) ?>
    <?= $form->field($searchModel, 'date')->widget(\yii\jui\DatePicker::class, ['dateFormat' => 'yyyy-MM'])?>
    <?= Html::submitButton('Отфильтровать') ?>
    <?php \yii\widgets\ActiveForm::end() ?>


    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'taskItem',
        'itemOptions' => function ($model) {
            return ['tag' => 'a', 'href' => \yii\helpers\Url::to(['task-view', 'id' => $model->id])];
        },
    ]) ?>

</div>
