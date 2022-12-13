<?php

namespace backend\controllers;


use common\models\BusinessStat;
use common\models\BusinessStatSearch;
use common\traits\AjaxValidationTrait;
use Yii;
use Yii\base\ExitException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BusinessStatController implements the CRUD actions for BusinessStat model.
 */
class BusinessStatController extends Controller
{
    use AjaxValidationTrait;
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all BusinessStat models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BusinessStatSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BusinessStat model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BusinessStat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws ExitException
     */
    public function actionCreate()
    {
        $model = new BusinessStat(['scenario' => BusinessStat::SCENARIO_CREATE]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                if ($model->save(false)) {
                    return $this->asJson([
                        'success' => true,
                        'msg' => Yii::t("app", 'Success')
                    ]);
                }
                else{
                    return $this->asJson([
                        'success' => false,
                        'msg' => Yii::t("app", 'Erorr in Save ')
                    ]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BusinessStat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = BusinessStat::SCENARIO_UPDATE;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/business/view', 'id' => $model->business['id']]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BusinessStat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->canDelete() && $model->softDelete()) {
            $this->flash('success', Yii::t('app', 'Stat Deleted'));
        } else {
            $this->flash('error', $model->errors ? array_values($model->errors)[0][0] : Yii::t('app', 'Error In Delete Action'));
        }

        return $this->redirect(['/business/view', 'id' => $model->business['id']]);
    }

    /**
     * Finds the BusinessStat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return BusinessStat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusinessStat::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type == 'error' ? 'danger' : $type, $message);
    }
}
