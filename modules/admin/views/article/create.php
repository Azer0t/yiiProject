<?php

use app\models\Topic;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Article $model */

$this->title = 'Створити публікацію';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'topics' => ArrayHelper::map(Topic::find()->all(),'id','name'),
        'users' => ArrayHelper::map(User::find()->all(),'id','name'),
    ]) ?>

</div>
