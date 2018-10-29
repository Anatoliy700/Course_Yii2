<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var \app\modules\lk\models\Image $model */

?>

<div class="image-form">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'image')->fileInput() ?>
    <?= Html::submitButton('Добавить') ?>
    <?php ActiveForm::end() ?>
</div>
