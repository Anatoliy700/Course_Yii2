<?php

use \yii\helpers\Html;

/* @var $model \app\models\tables\Images */

/* @var $taskId string */
?>

<div class="image-wrap col-md-3">
    <?= Html::beginTag('a', [
        'href' => Yii::getAlias('@taskImage/' . $model->name),
        'target' => '_blank',
    ]) ?>
    <?= Html::img(Yii::getAlias('@taskImage/small/' . $model->name)) ?>
    <?= Html::endTag('a') ?>
    <?php if (Yii::$app->user->can('productManager')): ?>
        <?= Html::a('Удалить', ['task/delete-image', 'imgId' => $model->id, 'taskId' => $taskId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить картинку?',
                'method' => 'post',
            ]
        ]) ?>
    <?php endif; ?>
</div>
