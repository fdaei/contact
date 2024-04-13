<?php

namespace backend\controllers;

use common\models\ContactSearch;
use common\models\LegalContact;
use common\models\RealContact;
use common\models\RealContactSearch;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactController implements the CRUD actions for RealContact model.
 */
class ContactController extends Controller
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
                    'class' => VerbFilter::className(),
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
        $legalContacts = LegalContact::find()
            ->select(['id','name', 'registration_city_id as city','national_id','economic_code','coin','registration_date','status', 'registration_province_id as province', 'registration_address as address'])
            ->asArray()
            ->all();

        $realContacts = RealContact::find()
            ->select(['id','last_name as name', 'birth_city_id as city','national_id','coin','registration_date','status', 'birth_province_id as province', 'birth_address as address'])
            ->asArray()
            ->all();
        foreach ($legalContacts as &$contact) {
            $contact['contact_type'] = 'Legal';
        }


        foreach ($realContacts as &$contact) {
            $contact['contact_type'] = 'Real';
        }

        $contacts = array_merge($legalContacts, $realContacts);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $contacts,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['name', 'city', 'province', 'address'],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
