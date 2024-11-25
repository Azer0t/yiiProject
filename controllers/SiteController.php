<?php

namespace app\controllers;

use app\models\Article;
use app\models\Comment;
use app\models\CommentForm;
use app\models\SearchForm;
use app\models\Topic;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Article::find();

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 2]);

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $popular = Article::find()->orderBy('viewed desc')->limit(1)->all();

        $recent = Article::find()->orderBy('date desc')->limit(1)->all();

        $topics = Topic::find()->all();

        return $this->render('index', [

            'articles' => $articles,
            'popular' => $popular,

            'recent' => $recent,

            'topics' => $topics,
            'pagination' => $pagination

        ]);
    }

    public function actionView($id)
    {

        $article = Article::findOne($id);

        $popular = Article::find()->orderBy('viewed desc')->limit(3)->all();

        $recent = Article::find()->orderBy('date desc')->limit(3)->all();

        $topics = Topic::find()->all();

        $comments = $article->comments;

        $commentsParent = array_filter($comments, function ($k) {

            return $k['comment_id'] == null;

        });

        $commentsChild = array_filter($comments, function ($k) {

            return ($k['comment_id'] != null && !$k['delete']);

        });

        $commentForm = new CommentForm();
        $article->viewedCounter();
        return $this->render('single', [

            'article' => $article,

            'popular' => $popular,

            'recent' => $recent,

            'topics' => $topics,

            'commentsParent' => $commentsParent,

            'commentsChild' => $commentsChild,

            'commentForm' => $commentForm,
        ]);
    }

    public function actionTopic($id)
    {

        $query = Article::find()->where(['topic_id' => $id]);


        $count = $query->count();


        // create a pagination object with the total count

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 1]);


        // limit the query using the pagination and retrieve the articles

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();


        $popular = Article::find()->orderBy('viewed desc')->limit(3)->all();

        $recent = Article::find()->orderBy('date desc')->limit(3)->all();

        $topics = Topic::find()->all();


        return $this->render('topic', [

            'articles' => $articles,

            'pagination' => $pagination,

            'popular' => $popular,

            'recent' => $recent,

            'topics' => $topics,

        ]);

    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome(); // Перенаправление на главную страницу
    }

    public function actionComment($id, $id_comment = null)
    {

        $model = new CommentForm();

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());

            if ($model->saveComment($id, $id_comment)) {

                return $this->redirect(['site/view', 'id' => $id]);

            }

        }

    }

    public function actionCommentDelete($id, $id_comment)
    {

        if (Yii::$app->request->isPost) {

            $data = Comment::findOne($id_comment);

            if ($data->user_id == Yii::$app->user->id) {

                $data->delete = true;

                $data->save(false);

            }

            return $this->redirect(['site/view', 'id' => $id]);

        }

    }

    public function actionSearch()

    {

        $model = new SearchForm();

        if (Yii::$app->request->isGet) {

            $model->load(Yii::$app->request->get());

            $data = $model->SearchAtricle(3);

            $popular = Article::find()->orderBy('viewed desc')->limit(3)->all();

            $recent = Article::find()->orderBy('date desc')->limit(3)->all();

            $topics = Topic::find()->all();

            return $this->render('search', [

                'articles' => $data['articles'],

                'pagination' => $data['pagination'],

                'popular' => $popular,

                'recent' => $recent,

                'topics' => $topics,

                'search' => $model->text

            ]);

        }

    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
