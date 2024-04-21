<?php

namespace backend\controllers;

use common\models\Model;
use common\models\Addresses;
use common\models\BankAccounts;
use common\models\Cards;
use common\models\Emails;
use common\models\FaxNumbers;
use common\models\MobileNumber;
use common\models\PhoneNumbers;
use common\models\RealContact;
use common\models\RealContactFile;
use common\models\RealContactSearch;
use common\models\ShabaNumbers;
use common\models\SocialLink;
use common\models\Tag;
use common\models\Websites;
use Yii;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
        $uploadFiles = [new RealContactFile];
        $searchedTags = Tag::find()->andWhere(['in', 'tag_id', $model->tagNames])->asArray()->all();
        $tagSelected = [];

        if ($model->load(Yii::$app->request->post())) {
            $model->contact_tag = Yii::$app->request->post('RealContact')['contact_tag'];
            $tagSelected = Yii::$app->request->post('RealContact')['contact_tag'];
            $searchedTags = Tag::find()->select(['tag_id', 'name'])->andWhere(['in', 'tag_id', $tagSelected])->asArray()->all();
            $Tag=new Tag();
            $tagSelected = $Tag->makeArrayOfTagId($tagSelected,$searchedTags);

            $mobileNumbersData = Yii::$app->request->post('MobileNumber', []);
            $mobileNumbers = MobileNumber::handelData($mobileNumbersData);
            $model->mobile_numbers = json_encode($mobileNumbers); // save as json

            $faxNumbersData = Yii::$app->request->post('FaxNumbers', []);
            $faxNumbers = FaxNumbers::handelData($faxNumbersData);
            $model->fax_numbers = json_encode($faxNumbers); // save as json


            $phoneNumbersData = Yii::$app->request->post('PhoneNumbers', []);
            $phoneNumbers = PhoneNumbers::handelData($phoneNumbersData);
            $model->phone_numbers = json_encode($phoneNumbers); // save as json


            $addressesData = Yii::$app->request->post('Addresses', []);
            $addresses = Addresses::handelData($addressesData);
            $model->addresses = json_encode($addresses); // save as json


            $bankAccountsData = Yii::$app->request->post('BankAccounts', []);
            $bankAccounts = BankAccounts::handelData($bankAccountsData);
            $model->bank_accounts = json_encode($bankAccounts); // save as json


            $cardsData = Yii::$app->request->post('Cards', []);
            $cards = Cards::handelData($cardsData);
            $model->cards = json_encode($cards); // save as json


            $emailsData = Yii::$app->request->post('Emails', []);
            $emails = Emails::handelData($emailsData);
            $model->emails = json_encode($emails); // save as json


            $shabaNumbersData = Yii::$app->request->post('ShabaNumbers', []);
            $shabaNumbers = ShabaNumbers::handelData($shabaNumbersData);
            $model->shaba_numbers = json_encode($shabaNumbers); // save as json


            $socialLinkData = Yii::$app->request->post('SocialLink', []);
            $socialLink = SocialLink::handelData($socialLinkData);
            $model->social_links = json_encode($socialLink); // save as json


            $websitesData = Yii::$app->request->post('Websites', []);
            $websites = Websites::handelData($websitesData);
            $model->websites = json_encode($websites); // save as json

            $uploadFiles = Model::createMultiple(RealContactFile::classname());
            Model::loadMultiple($uploadFiles, Yii::$app->request->post());

            var_dump($model->validate());die();
            $valid = $model->validate();
            $valid = Model::validateMultiple($uploadFiles) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
            if ($tagSelected) {
                $model->setTags($tagSelected, true);
            }
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($uploadFiles as $i => $uploadFile) {
                            $uploadFile->contact_id = $model->id;
                            $fileInstance = UploadedFile::getInstance($uploadFile, "[{$i}]file_path");

                            if ($fileInstance) {
                                $filePath = Yii::getAlias('@webroot') . '/upload/contact/real/' . $fileInstance->name;
                                if ($fileInstance->saveAs($filePath)) {
                                    $uploadFile->file_path = $fileInstance->name;
                                } else {
                                    Yii::$app->getSession()->setFlash('error', 'Error saving recipe images, Please enter valid images');
                                }
                            }

                            if (! ($flag = $uploadFile->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
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
            'uploadFile' => (empty($uploadFile)) ? [new RealContactFile] : $uploadFile,
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
    public function actionUpdate($id = null)
    {
        $model = $this->findModel($id);
        $mobileNumbers = MobileNumber::loadDefaultValue($model->mobile_numbers, MobileNumber::class);
        $faxNumbers = FaxNumbers::loadDefaultValue($model->fax_numbers, FaxNumbers::class);
        $phoneNumbers = PhoneNumbers::loadDefaultValue($model->phone_numbers, PhoneNumbers::class);
        $addresses = Addresses::loadDefaultValue($model->addresses, Addresses::class);
        $bankAccounts = BankAccounts::loadDefaultValue($model->bank_accounts, BankAccounts::class);
        $cards = Cards::loadDefaultValue($model->cards, Cards::class);
        $emails = Emails::loadDefaultValue($model->emails, Emails::class);
        $shabaNumbers = ShabaNumbers::loadDefaultValue($model->shaba_numbers, ShabaNumbers::class);
        $socialLink = SocialLink::loadDefaultValue($model->social_links, SocialLink::class);
        $websites = Websites::loadDefaultValue($model->websites, Websites::class);
        $uploadFiles = $model->file;
        $searchedTags = Tag::find()->andWhere(['in', 'tag_id', $model->tagNames])->asArray()->all();
        $tagSelected = [];

        if ($model->load(Yii::$app->request->post())) {
            $model->contact_tag = Yii::$app->request->post('RealContact')['contact_tag'];
            $tagSelected = Yii::$app->request->post('RealContact')['contact_tag'];
            $searchedTags = Tag::find()->select(['tag_id', 'name'])->andWhere(['in', 'tag_id', $tagSelected])->asArray()->all();
            $Tag=new Tag();
            $tagSelected = $Tag->makeArrayOfTagId($tagSelected,$searchedTags);

            $mobileNumbersData = Yii::$app->request->post('MobileNumber', []);
            $mobileNumbers = MobileNumber::handelData($mobileNumbersData);
            $model->mobile_numbers = json_encode($mobileNumbers); // save as json

            $faxNumbersData = Yii::$app->request->post('FaxNumbers', []);
            $faxNumbers = FaxNumbers::handelData($faxNumbersData);
            $model->fax_numbers = json_encode($faxNumbers); // save as json


            $phoneNumbersData = Yii::$app->request->post('PhoneNumbers', []);
            $phoneNumbers = PhoneNumbers::handelData($phoneNumbersData);
            $model->phone_numbers = json_encode($phoneNumbers); // save as json


            $addressesData = Yii::$app->request->post('Addresses', []);
            $addresses = Addresses::handelData($addressesData);
            $model->addresses = json_encode($addresses); // save as json


            $bankAccountsData = Yii::$app->request->post('BankAccounts', []);
            $bankAccounts = BankAccounts::handelData($bankAccountsData);
            $model->bank_accounts = json_encode($bankAccounts); // save as json


            $cardsData = Yii::$app->request->post('Cards', []);
            $cards = Cards::handelData($cardsData);
            $model->cards = json_encode($cards); // save as json


            $emailsData = Yii::$app->request->post('Emails', []);
            $emails = Emails::handelData($emailsData);
            $model->emails = json_encode($emails); // save as json


            $shabaNumbersData = Yii::$app->request->post('ShabaNumbers', []);
            $shabaNumbers = ShabaNumbers::handelData($shabaNumbersData);
            $model->shaba_numbers = json_encode($shabaNumbers); // save as json


            $socialLinkData = Yii::$app->request->post('SocialLink', []);
            $socialLink = SocialLink::handelData($socialLinkData);
            $model->social_links = json_encode($socialLink); // save as json


            $websitesData = Yii::$app->request->post('Websites', []);
            $websites = Websites::handelData($websitesData);
            $model->websites = json_encode($websites); // save as json

            $uploadFiles = Model::createMultiple(RealContactFile::classname());
            Model::loadMultiple($uploadFiles, Yii::$app->request->post());

            $valid = $model->validate();

            $valid = Model::validateMultiple($uploadFiles) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                if ($tagSelected) {
                    $model->setTags($tagSelected, true);
                }
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($uploadFiles as $i => $uploadFile) {
                            $uploadFile->contact_id = $model->id;
                            $fileInstance = UploadedFile::getInstance($uploadFile, "[{$i}]file_path");

                            if ($fileInstance) {
                                $filePath = Yii::getAlias('@webroot') . '/upload/contact/real/' . $fileInstance->name;
                                if ($fileInstance->saveAs($filePath)) {
                                    $uploadFile->file_path = $fileInstance->name;
                                } else {
                                    Yii::$app->getSession()->setFlash('error', 'Error saving recipe images, Please enter valid images');
                                }
                            }

                            if (! ($flag = $uploadFile->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
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
            'uploadFile' => (empty($uploadFile)) ? [new RealContactFile] : $uploadFile,
            'searchedTags' => $searchedTags,
            'tagSelected' => $tagSelected,
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
