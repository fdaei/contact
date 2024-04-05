<?php

namespace backend\controllers;

use backend\models\UploadForm;
use common\components\AuthHandler;
use common\components\AsiaTechSmsService;
use common\models\ChangePassword;
use common\models\Comments;
use common\models\CommentsType;
use common\models\LoginForm;
use common\models\mongo\MGActivityTracking;
use common\models\OauthAccessTokens;
use common\models\User;
use common\models\voip\SimoTellModel;
use common\traits\AjaxValidationTrait;
use common\traits\CoreTrait;
use nextvikas\authenticator\components\Authenticator;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    use CoreTrait;
    use AjaxValidationTrait;

    /**a
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'login', 'error', 'captcha',
                            'forgot-password', 'validate-code-forgot-password',
                            'verify-code','register',
                            'auth', 'is-guest','login-password'
                        ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['send-again'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'set-password', 'auth', 'change-password', 'captcha', 'report-bug', 'test-sms'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'google-auth', 'scan', 'check', 'disable', 'scale'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['upload'],
                        'allow' => true,
                        'roles' => ['admin', 'superadmin'],
                    ],
                    [
                        'actions' => ['price-crm', 'test-crm'],
                        'allow' => true,
                        'roles' => ['superadmin']
                    ],
                    [
                        'actions' => ['test'],
                        'allow' => true,
                        'roles' => ['superadmin']
                    ],
                    [
                        'actions' => ['debug'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return ArrayHelper::isIn(Yii::$app->user->id, [15031]);
                        },
                    ],
                    [
                        'actions' => ['terminate-all'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return ArrayHelper::isIn(Yii::$app->user->id, [15031, 90540, 91486]);
                        },
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'disable' => ['post'],
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
                'layout' => 'error',
                'view' => 'error'
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],//login
            ],
            'captcha' => [
                'class' => 'lubosdz\captchaExtended\CaptchaExtendedAction',
                // optionally, set mode and obfuscation properties e.g.:
                'mode' => 'math',
                //'resultMultiplier' => 5,
                //'lines' => 5,
                //'height' => 50,
                //'width' => 150,
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (ArrayHelper::isIn($action->id, ['upload', 'debug'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }




    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

    }


    public function actionChangePassword()
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->request->post()) && $model->change()) {
            Yii::$app->session->setFlash('success', 'کلمه عبور با موفقیت تغییر کرد');
            return $this->redirect(['profile/index']);
        }
        return $this->render('change_password', [
            'model' => $model
        ]);
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }
        $model = new LoginForm();
        $model->setScenario(LoginForm::SCENARIO_LOGIN_CODE_API);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->sendCode()) {

                Yii::$app->session->set("number", $model->number);
                Yii::$app->session->set('user.returnUrl', Yii::$app->user->returnUrl);
                return $this->render("_validate-code", [
                    'model' => $model
                ]);
            } else {
                return $this->render("login", [
                    'model' => $model,
                    'alert' => null
                ]);
            }
        } else {
            return $this->render("login", [
                'model' => $model,
                'alert' => null
            ]);
        }
    }
    public function actionLoginPassword()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'login';
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_back_STEP_1]);
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['profile/index']);
        }
        return $this->render('login_password', [
            'model' => $model,
        ]);
    }

    public function actionVerifyCode()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }

        $model = new LoginForm([
            'rememberMe' => true,
            'number' => Yii::$app->session->get("number")
        ]);


        $model->scenario = LoginForm::SCENARIO_back_STEP_2;

        if ($model->validate(['number'])) {
            $model->sendCode();
        } else {
            return $this->redirect(['login']);
        }

        $model->user = User::findByUsername($model->number);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->afterLogin();
                return $this->redirect(Yii::$app->user->returnUrl);
            } else {
                $model->setFailed();
            }
            return $this->render("_validate-code", [
                'model' => $model,
            ]);
        } else {
            return $this->render("_validate-code", [
                'model' => $model,
            ]);
        }
    }
    public function actionLogout()
    {

        Yii::$app->user->enableAutoLogin = true;
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionRegister()
    {
        $this->layout = 'login';
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_REGISTER]);
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect(['profile/index']);
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }


    public function actionIsGuest()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return Yii::$app->user->isGuest;
    }
}