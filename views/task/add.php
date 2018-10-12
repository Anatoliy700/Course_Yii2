<?php

use \yii\widgets\ActiveForm;
use \yii\helpers\Html;

?>

<h1><?= $message ?></h1>

<?php $form = ActiveForm::begin(); ?>
  <?= $form->field($model, 'date')->input('date') ?>
  <?= $form->field($model, 'title') ?>
  <?= $form->field($model, 'description')->textarea() ?>
  <?= HTML::submitButton('Добавить') ?>
<?php ActiveForm::end(); ?>
