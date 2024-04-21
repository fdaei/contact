<?php

use common\models\RealContact;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\RealContact $model */

\yii\web\YiiAsset::register($this);
?>
<div class="real-contact-view">
    <div class="card material-card">
        <div class="card-header d-flex justify-content-between">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id],
                    ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'image',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->image ? Html::img(Yii::$app->request->baseUrl . $model->getUploadUrl('image'), ['alt' => 'Image']) : null;
                        },
                    ],
                    'first_name',
                    'last_name',
                    'national_code',
                    'coin',
                    [
                        'attribute' => 'birth_city_id',
                        'value' => function ($model) {

                            return $model->province->name;
                        },
                    ],
                    [
                        'attribute' => 'birth_province_id',
                        'value' => function ($model) {

                            return $model->province->name;
                        },
                    ],
                    'birth_address',
                    'registration_date',
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {

                            return RealContact::itemAlias('Status',$model->status);
                        },
                    ],
                    'summary:ntext',
                    'description:ntext',
                    'mobile_numbers:ntext',
                    'social_links:ntext',
                    'phone_numbers:ntext',
                    'fax_numbers:ntext',
                    'addresses:ntext',
                    'emails:ntext',
                    'websites:ntext',
                    'bank_accounts:ntext',
                    'cards:ntext',
                    'shaba_numbers:ntext',
                    'created_at',
                    'created_by',
                    'updated_at',
                    'updated_by',
                    'deleted_at',
                ],
            ]) ?>
        </div>
    </div>
