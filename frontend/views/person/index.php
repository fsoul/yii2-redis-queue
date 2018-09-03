<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SearchPerson */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Persons List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="person-grid"><?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'first_name',
            'last_name',
            [
                'label' => 'Phones',

                'format' => 'html',
                'value' => function($model){
                    return join('<br>', yii\helpers\ArrayHelper::map($model->phones, 'number', 'number'));
                },
            ],

        ],
        ]); ?></div>
</div>
