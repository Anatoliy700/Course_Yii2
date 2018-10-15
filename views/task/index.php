<?php
/* @var $models \app\models\Task */
?>

<div class="container-fluid">
  <h5><a href="index.php?r=task/add" class="btn btn-primary btn-lg active">Добавить задание</a></h5>
  <div class="row">
    <?php foreach ($models as $model):?>
      <div class="col-sm-3">
        <p class="bg-primary"><?= $model->title?></p>
        <p class="bg-success"><?= $model->date?></p>
        <p class="bg-info"><?= $model->description?></p>
      </div>
    <?php endforeach;?>
  </div>
</div>