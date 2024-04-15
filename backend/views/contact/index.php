<?php

use common\models\LegalContact;
use common\models\RealContact;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Contacts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="real-contact-index bg-white p-3">

    <h2><?= Html::encode($this->title) ?></h2>

    <div class="text-right my-3">
        <?= Html::a(Yii::t('app', 'Create Contact'), ['/real-contact/create'], ['class' => 'btn btn-success text-left']) ?>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => Yii::t('app', 'Name'),
            ],
            [
                'attribute' => 'contact_type',
                'value' => function ($model) {
                    if ($model['contact_type'] == 'Real') {
                        return "حقیقی";
                    } elseif ($model['contact_type'] == 'Legal') {
                        return "حقوقی";
                    }
                    return $model['status'];
                },
                'label' => Yii::t('app', 'Contact Type'),
            ],
            [
                'attribute' => 'national_code',
                'label' => Yii::t('app', 'National Code'),
            ],
            [
                'attribute' => 'economic_code',
                'label' => Yii::t('app', 'Economic Code'),
            ],
            [
                'attribute' => 'coin',
                'label' => Yii::t('app', 'Coin'),
            ],
            [
                'attribute' => 'city',
                'label' => Yii::t('app', 'City'),
                'value'=>function($model){
                    return \common\models\City::findOne($model['city'])->name;
                }
            ],
            [
                'attribute' => 'province',
                'label' => Yii::t('app', 'Province'),
                'value'=>function($model){
                    return \common\models\Province::findOne($model['province'])->name;
                }
            ],
            [
                'attribute' => 'address',
                'label' => Yii::t('app', 'Address'),
            ],
            [
                'attribute' => 'registration_date',
                'label' => Yii::t('app', 'Registration Date'),
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    if ($model['contact_type'] == 'Real') {
                        return RealContact::itemAlias('Status', $model['status']);
                    } elseif ($model['contact_type'] == 'Legal') {
                        return LegalContact::itemAlias('Status', $model['status']);
                    }
                    return $model['status'];
                },
                'label' => Yii::t('app', 'Status'),
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        if ($model['contact_type'] == 'Real') {
                            return Html::a('<span class="fa fa-eye text-warning"></span>', ['update-real', 'id' => $model['id']]);
                        } elseif ($model['contact_type'] == 'Legal') {
                            return Html::a('<span class="fa fa-eye text-warning"></span>', ['update-legal', 'id' => $model['id']]);
                        }
                    },
                    'update' => function ($url, $model, $key) {
                        if ($model['contact_type'] == 'Real') {
                            return Html::a('<span class="fa fa-pencil text-info"></span>', ['update-real', 'id' => $model['id']]);
                        } elseif ($model['contact_type'] == 'Legal') {
                            return Html::a('<span class="fa fa-pencil text-info"></span>', ['update-legal', 'id' => $model['id']]);
                        }
                    },
                    'delete' => function ($url, $model, $key) {
                        if ($model['contact_type'] == 'Real') {
                            return Html::a('<span class="fa fa-trash text-danger"></span>', ['delete-real', 'id' => $model['id']], [
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                            ]);
                        } elseif ($model['contact_type'] == 'Legal') {
                            return Html::a('<span class="fa fa-trash text-danger"></span>', ['delete-legal', 'id' => $model['id']], [
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },
                ],
            ],
        ],
    ]); ?>


    <?php Pjax::end(); ?>

</div>
