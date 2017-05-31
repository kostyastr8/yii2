<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;






class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        if (!\Yii::$app->user->can('view', ['profileId' => \Yii::$app->user->id])) {
//            die('Access denied');
//        }
        return $this->render('index');

    }

    /**
     * Login action.
     *
     * @return string
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
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionTest1()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (!Yii::$app->user->can('view1', ['profileId' => \Yii::$app->user->id])) {
            die('Access denied');
        }

        return $this->render('test1');
    }

    public function actionTest2()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (!Yii::$app->user->can('view2', ['profileId' => \Yii::$app->user->id])) {
            die('Access denied');
        }

        return $this->render('test2');
    }

    public function actionTest3()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (!Yii::$app->user->can('view3', ['profileId' => \Yii::$app->user->id])) {
            die('Access denied');
        }

        return $this->render('test3');
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
//        if (!\Yii::$app->user->can('update', ['profileId' => \Yii::$app->user->id])) {
//            die('Access denied');
//        }

        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout($id=null)
    {
        return $this->render('about');
    }


    public function actionSignup()
    {
        $model = new SignupForm();

        $modelUploading = new UploadForm();

//        echo "<pre>";
//        print_r(Yii::$app->request->post());
//        echo "<hr>";
//        print_r($GLOBALS);
//        echo "</pre>";
//        die;

        if ($model->load(Yii::$app->request->post())) {

            $modelUploading->imageFiles = UploadedFile::getInstances($modelUploading, 'imageFiles');

            if ($modelUploading->upload()) {
            }
            if ($user = $model->signup()) {
                 Yii::$app->user->login($user);

                 return $this->goHome();
            }
        }

        return $this->render('registration', [
            'model' => $model,
            'modelUploading' => $modelUploading
        ]);

    }


//    public function actionAvatarUpdate()
//    {
//        $out = ['status' => false];
//
//        if (Yii::$app->request->isAjax)
//        {
//            $avatar = new Picture();
//            $modelUser = User::findOne(Yii::$app->user->identity->id);
//
//            $avatar->imageFiles = new UploadedFile([
//                'name' => $_FILES[0]['name'],
//                'tempName' => $_FILES[0]['tmp_name'],
//                'type' => $_FILES[0]['type'],
//                'size' => $_FILES[0]['size'],
//                'error' => $_FILES[0]['error'],
//            ]);
//
//            if($avatar->save())
//            {
//                if($modelUser->pictures)
//                {
//                    foreach ($modelUser->pictures as $picture)
//                    {
//                        if(!$picture->delete())
//                            Yii::error('MyError Cant remove user Avatar | unlink($folder . "/" . $this->name) return false; ', __METHOD__);
//                    }
//                }
//                $modelUserAvatar = new UserPicture;
//                $modelUserAvatar->picture_id = $avatar->id;
//                $modelUserAvatar->user_id = $modelUser->id;
//                if($modelUserAvatar->save())
//                    $out['status'] = true;
//            }
//            else {
//                $out['errorMessage'] = true;
//                Yii::$app->session->setFlash(Alerts::TYPE_ERROR, implode(', ', $avatar->getErrors('imageFiles')));
//            }
//        }
//
//        echo Json::encode($out);;
//    }

//    public function beforeAction($action)
//    {
//        if (parent::beforeAction($action)) {
//            if (!\Yii::$app->user->can($action->id)) {
//                throw new ForbiddenHttpException('Access denied');
//            }
//            return true;
//        } else {
//            return false;
//        }
//    }

}
