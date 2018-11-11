<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\tables\Images */
/* @var $tasks array */

$this->title = 'Create Images';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tasks' => $tasks,
    ]) ?>

</div>
