<?php

/* @var $this yii\web\View */

/* @var $form yii\bootstrap5\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;

use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-login">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([

        'id' => 'login-form',

        'layout' => 'horizontal',

        'fieldConfig' => [

            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",

            'labelOptions' => ['class' => 'col-lg-1 control-label'],

        ],

    ]); ?>

    <?= $form->field($model, 'name') ->label('Ім`я користувача')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'login') ->label('Пошта')->textInput() ?>

    <?= $form->field($model, 'password') ->label('Пароль')->passwordInput() ?>

    <div class="form-group">

        <div class="col-lg-offset-1 col-lg-11">

            <?= Html::submitButton(' Зареєструватись ', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>