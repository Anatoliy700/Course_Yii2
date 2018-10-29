<?php
use \yii\helpers\Html;
/* @var $model \app\models\tables\Images */
?>

<div class="image-wrap col-md-3">
    <?= Html::beginTag('a', [
        'href' => Yii::getAlias('@web/img/' . $model->name),
        'target' => '_blank',
        ]) ?>
    <?= Html::img(Yii::getAlias('@web/img/small/' . $model->name)) ?>
    <?= Html::endTag('a') ?>
</div>
