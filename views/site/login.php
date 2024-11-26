<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Авторизація';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'username')
                ->label('Пошта')  // Задание кастомной метки для поля 'username'
                ->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')
                ->label('Пароль')  // Задание кастомной метки для поля 'password'
                ->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')
                ->label('Remember me')  // Задание кастомной метки для поля 'rememberMe'
                ->checkbox() ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Авторизація', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <?= Html::a('Реєстрація', ['/auth/signup'], ['class'=>'btn btn-success'])?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>



        </div>
    </div>
</div>
