<?php

use common\models\JobPosition;
use common\models\JobPositionSearch;
use common\widgets\grid\ActionColumn;
use common\widgets\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/** @var View $this */
/** @var JobPositionSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Job Positions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-position-index card material-card">
    <div class="card-header d-flex justify-content-between">
        <h2><?= Html::encode($this->title) ?></h2>

        <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right " data-toggle="modal"  data-target="#add-contact">
            <?= Html::a(Yii::t('app', 'Create Job Position'), ['create'], ['class' => 'text-white']) ?>
        </button>
    </div>
    <?php Pjax::begin(); ?>
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                [
                    'attribute' => 'org_unit_id',
                    'value' => 'orgUnit.title',
                ],
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, JobPosition $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>