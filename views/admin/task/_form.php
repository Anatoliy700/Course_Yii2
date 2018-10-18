<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
/* @var $users array */

?>

<div class="tasks-form">
  
  <?php $form = ActiveForm::begin(); ?>
  
  <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
  
  <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
  
  <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

  <!--    --><? //= $form->field($model, 'user_id')->textInput() ?>
  
  <?= $form->field($model, 'user_id')->dropDownList($users) ?>

  <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
  </div>
  
  <?php ActiveForm::end(); ?>

</div>
