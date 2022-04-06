<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Todotask */

$this->title = 'Create Todotask';
$this->params['breadcrumbs'][] = ['label' => 'Todotasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="todotask-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
