<?php
use \yii\helpers\Html;
/* @var $model \app\models\tables\Images */
?>

<div class="image-wrap col-md-3">
    <?= Html::beginTag('a', [
        'href' => Yii::getAlias('@taskImage/' . $model->name),
        'target' => '_blank',
        ]) ?>
    <?= Html::img(Yii::getAlias('@taskImage/small/' . $model->name)) ?>
    <?= Html::endTag('a') ?>
</div>
