<?php

namespace backend\controllers;

use backend\models\User;
use backend\modules\employee\models\EmployeeRollCallSearch;
use backend\modules\employee\models\SalaryPeriod;
use backend\modules\employee\models\SalaryPeriodItems;
use backend\modules\employee\models\SalaryPeriodItemsSearch;
use common\components\Helper;
use common\components\jdf\Jdf;
use common\models\UserPointsSearch;
use common\traits\AjaxValidationTrait;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class ProfileController
 * @package backend\controllers
 * @author Nader <nader.bahadorii@gmail.com>
 */
class ProfileController extends Controller
{
    use AjaxValidationTrait;

    public $layout = 'profile';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' =>
                    [
                        [
                            'allow' => true,
                            'roles' => ['MBT_WORKER'],
                        ],
                    ]
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionPoints()
    {
        $searchModel = new UserPointsSearch();
        $dataProvider = $searchModel->searchMine($this->request->queryParams, Yii::$app->user->id);

        return $this->render('points', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSalaryPeriod()
    {
        $searchModel = new SalaryPeriodItemsSearch(['user_id' => Yii::$app->user->id]);
        $dataProvider = $searchModel->searchUser(Yii::$app->request->queryParams);
        $dataProvider->query
            ->joinWith('period')
            ->andWhere([SalaryPeriod::tableName() . '.status' => SalaryPeriod::STATUS_PAYMENT])
            ->andWhere([SalaryPeriodItems::tableName() . '.can_payment' => Helper::CHECKED])
            ->andWhere(['user_id' => Yii::$app->user->id]);
        return $this->render('salary-period', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPrintSingleItem($id): string
    {
        $this->layout = '@backend/views/layouts/print-bootstrap';
        $salaryPeriodItem = $this->findModelSalaryItem($id);
        if (!$salaryPeriodItem->canPrint()) {
            throw new ForbiddenHttpException('امکان چاپ وجود ندارد');
        }
        return $this->render('print-single-item', [
            'model' => $salaryPeriodItem,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionViewSingleItem($id): string
    {
        $salaryPeriodItem = $this->findModelSalaryItem($id);
        if (!$salaryPeriodItem->canPrint()) {
            throw new ForbiddenHttpException('امکان مشاهده وجود ندارد');
        }
        return $this->render('view-single-item', [
            'model' => $salaryPeriodItem,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionRollCall()
    {
        $searchModel = new EmployeeRollCallSearch();

        $startAndEndOfCurrentMonth = Jdf::getStartAndEndOfCurrentMonth();
        $start_month = Yii::$app->jdate->date('Y/m/d', $startAndEndOfCurrentMonth[0]);
        $end_month = Yii::$app->jdate->date('Y/m/d', $startAndEndOfCurrentMonth[1]);
        $searchModel->fromDate = $start_month;
        $searchModel->toDate = $end_month;
        $dataProvider = $searchModel->searchUser(Yii::$app->request->queryParams, Yii::$app->user->id);
        return $this->render('roll-call', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return array|string
     * @throws NotFoundHttpException
     * @throws Yii\base\ExitException
     */
    public function actionSetEmail()
    {
        $model = $this->findModelUser(Yii::$app->user->id);
        $model->setScenario(User::SCENARIO_UPDATE_PROFILE);
        $result = [
            'success' => false,
            'msg' => Yii::t("app", "Error In Save Info")
        ];
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $flag = $model->save(false);
                if ($flag) {
                    $result = [
                        'success' => true,
                        'msg' => Yii::t("app", "Item Created")
                    ];
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::error($e->getMessage() . $e->getTraceAsString(), Yii::$app->controller->id . '/' . Yii::$app->controller->action->id);
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $result;
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('_set-email', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    /**
     * @param $id
     * @return SalaryPeriodItems|null
     * @throws NotFoundHttpException
     */
    protected function findModelSalaryItem($id)
    {
        if (($model = SalaryPeriodItems::findOne($id)) !== null && $model->user_id == Yii::$app->user->id) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    public function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type == 'error' ? 'danger' : $type, $message);
    }
}
