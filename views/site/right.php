<?php use yii\helpers\Url; ?>
<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">
        <aside class="border pos-padding widget-search">
            <?php $form = \yii\widgets\ActiveForm::begin([
                'method' => 'get',
                'action' => Url::to(['site/search']),
                'options' => ['class' => 'search-form', 'role' => 'form']]) ?>
            <?php $searchForm = new \app\models\SearchForm() ?>
            <?= $form->field($searchForm, 'text')->textInput(['class' => 'form-control serch', 'placeholder' => 'Пошук'])->label(false) ?>
            <?php \yii\widgets\ActiveForm::end() ?>
        </aside>
        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Популярні публікації</h3>
            <?php foreach ($popular as $article) : ?>
                <div class="popular-post">
                    <a href="<?= Url::toRoute(['/view', 'id' => $article->id]) ?>" class="popular-img">
                        <img class="img-sideBar" src="<?= $article->getImage() ?>" alt="">
                        <div class="p-overlay"></div>
                    </a>
                    <div class="p-content">
                        <a href="<?= Url::toRoute(['/view', 'id' => $article->id]) ?>"
                           class="text-uppercase"><?= $article->title; ?></a>
                        <span class="p-date"><?= $article->getDate(); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </aside>
        <aside class="widget pos-padding">
            <?php foreach ($recent as $article) : ?>
                <h3 class="widget-title text-uppercase text-center">Останні публікації</h3>
                <div class="thumb-latest-posts">
                    <div class="media">
                        <div class="media-left">
                            <a href="<?= Url::toRoute(['/view', 'id' => $article->id]) ?>" class="popular-img">
                                <img class="img-sideBar" src="<?= $article->getImage() ?>" alt="">
                                <div class="p-overlay"></div>
                            </a>
                        </div>
                        <div class="p-content">
                            <a href="<?= Url::toRoute(['/view', 'id' => $article->id]) ?>"
                               class=" text-uppercase"><?= $article->title; ?></a>
                            <span class="p-date"><?= $article->getDate(); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Категорії</h3>
            <ul>
                <?php foreach ($topics as $topic): ?>
                    <li>
                        <a href="<?= Url::toRoute(['/topic', 'id' => $topic->id]) ?>"><?= $topic->name; ?></a>
                        <span class="post-count pull-right"> (<?= $topic->getArticles()->count(); ?>)</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>
    </div>
</div>