<?php

/** @var yii\web\View $this */
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\widgets\LinkPager;

/* @var $dataProvider yii\data\ArrayDataProvider */

//var_dump($dataProvider->allModels);
//die;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' =>[
                'id',
                'name',
                'email',
                'body',
        ],
    ]);

    ?>

    <?=
    LinkPager::widget([
        'options' => ['class' => 'pagination justify-content-center'],
        'linkOptions' => ['class' => 'page-link text-green'],
        'pagination' => $dataProvider->pagination,
        'maxButtonCount' => 5,
        'activePageCssClass' => 'active',
        'nextPageLabel' => 'Next',
        'prevPageLabel' => 'Prev',
    ]);
    ?>


</div>
