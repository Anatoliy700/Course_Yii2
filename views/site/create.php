<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-create">
    <h1><?= Html::encode($this->title) ?></h1>
    
    
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'first_name') ?>
    <?= $form->field($model, 'last_name') ?>
    <?= $form->field($model, 'email')->input('email') ?>
    <?= $form->field($model, 'password_repeat')->passwordInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- create -->
