<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searchModels\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <p>
    <?= Html::a('Create Tasks', ['create'], ['class' => 'btn btn-success']) ?>
  </p>
    <?php $form = \yii\widgets\ActiveForm::begin(['method' => 'get']) ?>
    <?= $form->field($searchModel, 'date')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM',
        'options' => [
            'class' => 'form-control'
        ]
    ])?>
    <?=  $form->field($searchModel, 'username')->textInput() ?>
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
