<?php

namespace backend\controllers;

use backend\models\MentorRecords;
use common\models\Mentor;
use common\models\MentorSearch;
use common\traits\AjaxValidationTrait;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;

/**
 * MentorController implements the CRUD actions for Mentor model.
 */
class MentorController extends Controller
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
     * Lists all Mentor models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MentorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mentor model.
     * @param int $id ایدی
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
     * Creates a new Mentor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Mentor();
        $model->scenario = 'form';
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
               $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionPicCreate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->validate() && $model->save(false) ) {
                return $this->asJson([
                    'success' => true,
                    'msg' => Yii::t("app", 'Success')
                ]);
            }
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('_picture', [
            'model' => $model,
        ]);
    }

    public function actionPicUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->validate() && $model->save(false) ) {
                return $this->asJson([
                    'success' => true,
                    'msg' => Yii::t("app", 'Success')
                ]);
            }
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('_picture', [
            'model' => $model,
        ]);
    }
    public function actionCreateRecords($id)
    {
        $model = $this->findModel($id);
        $form = new ActiveForm();
        $MentorRecords = [new MentorRecords()];
        if ($this->request->isPost) {
            $newData = MentorRecords::handelData();
            $newModels = [];
            foreach ($newData as $item) {
                $newModel = new MentorRecords();
                $newModel->attributes = $item;
                $newModels[] = $newModel;
            }

            $isValid = MentorRecords::validateMultiple($newModels);
            if ($isValid) {
                if($model->records){
                    $model->records = array_merge($model->records, $newData);
                }else {
                    $model->records = $newData;
                }
                if ($model->save(false)) {
                    return $this->asJson([
                        'success' => true,
                        'msg' => Yii::t("app", 'Success')
                    ]);
                }
            }
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('_records', [
            'model' => $model,
            'MentorRecords' => $MentorRecords,
        ]);
    }
    public function actionUpdateRecords($id)
    {
        $model = $this->findModel($id);
        $form = new ActiveForm();
        if ($this->request->isPost) {
            $model->records  =  MentorRecords::handelData();
            foreach ( $model->records  as $item) {
                $newModel = new MentorRecords();
                $newModel->attributes = $item;
                $newModels[] = $newModel;
            }
            // Validate all models
            $isValid = MentorRecords::validateMultiple($newModels);
            if($model->save(false)){
                return $this->asJson([
                    'success' => true,
                    'msg' => Yii::t("app", 'Success')
                ]);
            }
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('_records', [
            'model' => $model,
            'MentorRecords' => MentorRecords::loadDefaultValue($model->records),
            'form' => $form,
        ]);

    }

    /**
     * Updates an existing Mentor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ایدی
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing Mentor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ایدی
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->canDelete() && $model->deleted()) {
            $this->flash('success', Yii::t('app', 'Item Deleted'));
        } else {
            $this->flash('error', $model->errors ? array_values($model->errors)[0][0] : Yii::t('app', 'Error In Delete Action'));
        }

        return $this->redirect(['index']);
    }
    public function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type == 'error' ? 'danger' : $type, $message);
    }
    /**
     * Finds the Mentor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ایدی
     * @return Mentor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mentor::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
