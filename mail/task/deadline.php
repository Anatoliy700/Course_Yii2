<?php
/* @var $user \app\models\tables\Users */
?>

<h3>
    <?= $user->first_name . ' ' . $user->last_name ?>,
    у вас на завтра
    <?= Yii::t(
        'app',
        '{n, plural, one{# задача} few{# задачи} many{# задач} other{# задачи}}',
        ['n' => count($user->tasks)]
    ) ?>
</h3>
<il>
    <?php foreach ($user->tasks as $task): ?>
        <li><?= $task->title ?></li>
    <?php endforeach; ?>
</il>