<?php

use common\models\Tag;
use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\TagSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = Yii::t('app', 'Tags');

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index card material-card">
    <?php Pjax::begin(['id' => 'p-jax-tag-form']); ?>
    <div class="card-header d-flex justify-content-between">
        <h3><?= Html::encode($this->title) ?></h3>
        <p>
            <?= Html::a(Yii::t('app', 'create tag'), "javascript:void(0)",
                [
                    'data-pjax' => '0',
                    'class' => "btn btn-success text-left",
                    'data-size' => 'modal-xl',
                    'data-title' => Yii::t('app', 'create'),
                    'data-toggle' => 'modal',
                    'data-target' => '#modal-pjax',
                    'data-url' => Url::to(['/tag/create']),
                    'data-handle-form-submit' => 1,
                    'data-show-loading' => 0,
                    'data-reload-pjax-container' => 'p-jax-tag-form',
                    'data-reload-pjax-container-on-show' => 0
                ]) ?>

        </p>
    </div>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'frequency',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {

                        return Tag::itemAlias('Status',$model->status);
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
                                    'data-url' => Url::to(['/tag/update', 'id' => $model->tag_id]),
                                    'data-handle-form-submit' => 1,
                                    'data-show-loading' => 0,
                                    'data-reload-pjax-container' => 'p-jax-tag-form',
                                    'data-reload-pjax-container-on-show' => 0
                                ]
                            );
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a(Html::tag('span', Yii::t('app', '<span class="fa fa-trash text-danger"></span>')), 'javascript:void(0)',
                                [
                                    'title' => Yii::t('yii', 'delete'),
                                    'aria-label' => Yii::t('yii', 'delete'),
                                    'data-reload-pjax-container' => 'p-jax-tag-form',
                                    'data-pjax' => '0',
                                    'data-url' => Url::to(['/tag/delete', 'id' => $model->tag_id]),
                                    'data-title' => Yii::t('yii', 'delete'),
                                    'data-toggle' => 'tooltip',
                                ]
                            );
                        },
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'update') {
                            return Url::to(['/tag/update', 'id' => $model->tag_id]);
                        } else if ($action === 'delete') {
                            return Url::to(['/tag/delete', 'id' => $model->tag_id]);
                        }
                    },
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>


    </div>
    <?php Pjax::end(); ?>

</div>
