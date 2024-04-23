<?php

use common\models\City;
use common\models\CitySearch;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/** @var View $this */
/** @var CitySearch $searchModel */
/** @var ActiveDataProvider $dataProvider */
/** @var City $model */

$this->title = Yii::t('app', 'Cities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index card material-card">
    <?php Pjax::begin(['id' => 'p-jax-city-form']); ?>
    <div class="card-header d-flex justify-content-between">
        <h2><?= Html::encode($this->title) ?></h2>
        <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
            [
                'data-pjax' => '0',
                'class' => "btn btn-success text-left",
                'data-size' => 'modal-xl',
                'data-title' => Yii::t('app', 'create'),
                'data-toggle' => 'modal',
                'data-target' => '#modal-pjax',
                'data-url' => Url::to(['/city/create']),
                'data-handle-form-submit' => 1,
                'data-show-loading' => 0,
                'data-reload-pjax-container' => 'p-jax-city-form',
                'data-reload-pjax-container-on-show' => 0
            ]) ?>
    </div>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,

            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                [
                    'attribute' => 'province_id',
                    'value' => function ($model) {
                        return $model->province->name;
                    },
                ],
                [
                    'class' => ActionColumn::class,
                    'template' => ' {update} {delete} ',
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a(Yii::t('app', '<span class="fa fa-pencil text-info"></span>'), "javascript:void(0)",
                                [
                                    'data-pjax' => '0',
                                    'data-size' => 'modal-xl',
                                    'data-title' => Yii::t('app', 'Update'),
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-pjax',
                                    'data-url' => Url::to(['/city/update', 'id' => $model->id]),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-city-form',
                                    'data-reload-pjax-container-on-show' => 0
                                ]
                            );
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a(Html::tag('span', '<span class="fa fa-trash text-danger"></span>'), 'javascript:void(0)',
                                [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'aria-label' => Yii::t('yii', 'Delete'),
                                    'data-reload-pjax-container' => 'p-jax-city-form',
                                    'data-pjax' => '0',
                                    'data-url' => Url::to(['city/delete', 'id' => $model->id]),
                                    'class' => " text-danger p-jax-btn",
                                    'data-title' => Yii::t('yii', 'Delete'),
                                    'data-toggle' => 'tooltip',
                                    'data-method' => 'post'

                                ]);
                        }
                    ],
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>
