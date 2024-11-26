<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php

    NavBar::begin([
        'brandLabel' => 'Книжковий блог',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top'],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => array_filter([
            ['label' => 'Головна сторінка', 'url' => ['/site/index']],

            !Yii::$app->user->isGuest
                ? ['label' => 'Користувач', 'url' => ['/user/user']]
                : null,
            !Yii::$app->user->isGuest
                ? ['label' => 'Мої публікації', 'url' => ['/user/article']]
                : null,
            !Yii::$app->user->isGuest && Yii::$app->user->identity->login === 'oleksandr.kopytenko@gmail.com'
                ? ['label' => 'Адміністративна панель', 'url' => ['/admin/user']]
                : null,
            Yii::$app->user->isGuest
                ? ['label' => 'Авторизація', 'url' => ['/auth/login']]
                : '<li class="nav-item">'
                . Html::beginForm(['/site/logout'])
                . Html::submitButton(
                    'Вийти з аккаунту (' . Yii::$app->user->identity->name . ')',
                    ['class' => 'nav-link btn btn-link logout']
                )
                . Html::endForm()
                . '</li>',


        ]),
    ]);
    NavBar::end();
    ?>
</header>


<div class="container">

    <!--main content start-->

    <div class="main-content">

        <div class="container">

            <div class="row">

                <?= $content ?>

            </div>

        </div>

    </div>

</div>

</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
