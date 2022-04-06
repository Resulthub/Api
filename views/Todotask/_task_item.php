<?php

/** @var $model \app\models\Article */

?>

<div>
    <a href="<?php echo yii\helpers\Url::to(['todotask/view', 'id' => $model->id])?>">
        <h3><?php echo yii\helpers\Html::encode($model->task)  ?></h3>
    </a>
    <div>
        <?php echo $model->status ?>
    </div>

    <p class="text-muted text-right">
        <small>Date: <b><?php echo $model->date ?></b>
        </small>
    </p>
    <hr>
</div>
