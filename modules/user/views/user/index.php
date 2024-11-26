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
                'format' => 'html',  // Указываем формат как HTML
                'label' => 'Image',  // Подпись для изображения
                'value' => function ($data) {
                    // Используем Yii::getAlias('@web'), чтобы правильно формировать URL
                    return '<img src="' . Yii::getAlias('@web/' . $data->getImage()) . '" width="200" height="150" alt="Image description">';
                }
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],

        ],

    ]);  ?>


</div>
