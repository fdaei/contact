<?php

use common\models\RealContact;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\RealContactSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Real Contacts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="real-contact-index card material-card">
    <div class="card-header d-flex justify-content-between">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Real Contact'), ['create'], ['class' => 'btn btn-primary']) ?>

    </p>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'image',
            'first_name',
            'last_name',
            'national_id',
            //'coin',
            //'birth_city_id',
            //'birth_province_id',
            //'birth_address',
            //'registration_date',
            //'status',
            //'summary:ntext',
            //'description:ntext',
            //'mobile_numbers:ntext',
            //'social_links:ntext',
            //'phone_numbers:ntext',
            //'fax_numbers:ntext',
            //'addresses:ntext',
            //'emails:ntext',
            //'websites:ntext',
            //'bank_accounts:ntext',
            //'cards:ntext',
            //'shaba_numbers:ntext',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'deleted_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, RealContact $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
