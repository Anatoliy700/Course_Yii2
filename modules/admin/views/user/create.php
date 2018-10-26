<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\tables\Users */
/* @var $roles \app\models\tables\Roles */

$this->title = 'Create Users';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'roles' => $roles
    ]) ?>

</div>
