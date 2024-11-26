<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Article $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Встановити картинку', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені що хочете видалити цей обєкт?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'date',
            [
                'format' => 'html',  // Указываем формат как HTML
                'label' => 'Image',  // Подпись для изображения
                'value' => function ($data) {
                    // Используем Yii::getAlias('@web'), чтобы правильно формировать URL
                    return '<img src="' . Yii::getAlias('@web/' . $data->getImage()) . '" width="200" height="150" alt="Image description">';
                }
            ],
            'tag',
            'viewed',
            'topic_id',
            'user_id',
        ],
    ]) ?>

</div>
