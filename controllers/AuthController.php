<?php

namespace app\controllers;

use app\models\LoginForm;

use app\models\SignupForm;
use app\models\User;

use Yii;

use yii\web\Controller;

use yii\web\Response;

class AuthController extends Controller

{

    /**

     * Login action.

     *

     * @return Response|string

     */

    public function actionLogin()

    {

        if (!Yii::$app->user->isGuest) {

            return $this->goHome();

        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->goBack();

        }

        $model->password = '';

        return $this->render('/site/login.php', [

            'model' => $model,

        ]);

    }

    /**

     * Logout action.

     *

     * @return Response

     */


    public function actionSignup()
    {
        $model = new SignupForm();
        if (Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if ($model->signup())
            {
                return $this->redirect(['auth/login']);
            }
        }
        return $this->render('/site/signup',['model'=>$model]);
    }
}