<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TodotaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'To-Do Tasks';

$this->params['breadcrumbs'][] = $this->title;
?>
<p></p>
<div class="todotask-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest) : ?>
        <p>
            <?= Html::a('Create Todotask', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>


    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_task_item'
    ]); ?>



</div>
