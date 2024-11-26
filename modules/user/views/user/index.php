<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Користувач';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>




    <?= GridView::widget([

        'dataProvider' => $dataProvider,

        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],

            'id',

            'name',

            'login',

            'password',

            [

                'format' => 'html',

                'label' => 'Image',

                'value' => function ($data) {

                    return Html::img($data->getImage(), ['width' => 200]);

                }

            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],

        ],

    ]);  ?>


</div>
