<?php

namespace backend\controllers;

use common\models\Addresses;
use common\models\BankAccounts;
use common\models\Cards;
use common\models\Emails;
use common\models\FaxNumbers;
use common\models\MobileNumber;
use common\models\PhoneNumbers;
use common\models\RealContact;
use common\models\RealContactSearch;
use common\models\ShabaNumbers;
use common\models\SocialLink;
use common\models\Tag;
use common\models\Websites;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RealContactController implements the CRUD actions for RealContact model.
 */
class RealContactController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
     * Lists all RealContact models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RealContactSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RealContact model.
     * @param int $id شناسه
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
     * Creates a new RealContact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return array
     */
    public function actionCreate()
    {
        $model = new RealContact();
        $mobileNumbers = [new MobileNumber()];
        $faxNumbers = [new FaxNumbers()];
        $phoneNumbers = [new PhoneNumbers()];
        $addresses = [new Addresses()];
        $bankAccounts = [new BankAccounts()];
        $cards = [new Cards()];
        $emails = [new Emails()];
        $shabaNumbers = [new ShabaNumbers()];
        $socialLink = [new SocialLink()];
        $websites = [new Websites()];
        $searchedTags = Tag::find()->andWhere(['in', 'tag_id', $model->tagNames])->asArray()->all();
        $tagSelected = [];
        if ($model->load(Yii::$app->request->post())) {

            $model->event_tag = Yii::$app->request->post('Event')['event_tag'];
            $tagSelected = Yii::$app->request->post('Event')['event_tag'];
            $searchedTags = Tag::find()->select(['tag_id', 'name'])->andWhere(['in', 'tag_id', $tagSelected])->asArray()->all();
            $Tag=new Tag();
            $tagSelected = $Tag->makeArrayOfTagId($tagSelected,$searchedTags);
        }

        return $this->render('create', [
            'model' => $model,
            'mobileNumbers' => (empty($mobileNumbers)) ? [new MobileNumber()] : $mobileNumbers,
            'faxNumbers' => (empty($faxNumbers)) ? [new FaxNumbers()] : $faxNumbers,
            'phoneNumbers' => (empty($phoneNumbers)) ? [new PhoneNumbers()] : $phoneNumbers,
            'addresses' => (empty($addresses)) ? [new Addresses()] : $addresses,
            'bankAccounts' => (empty($bankAccounts)) ? [new BankAccounts()] : $bankAccounts,
            'cards' => (empty($cards)) ? [new Cards()] : $cards,
            'emails' => (empty($emails)) ? [new Emails()] : $emails,
            'shabaNumbers' => (empty($shabaNumbers)) ? [new ShabaNumbers()] : $shabaNumbers,
            'socialLink' => (empty($socialLink)) ? [new SocialLink()] : $socialLink,
            'websites' => (empty($websites)) ? [new Websites()] : $websites,
            'searchedTags' => $searchedTags,
            'tagSelected' => $tagSelected,
        ]);
    }




    /**
     * Updates an existing RealContact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id شناسه
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
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RealContact model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id شناسه
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RealContact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id شناسه
     * @return RealContact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RealContact::findOne(['id' => $id])) !== null) {
            return $model;
        }

    }
}
