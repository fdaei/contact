<?php

use common\models\CareerApply;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\CareerApplySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Career Applies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="career-apply-index card material-card">
    <div class="card-header d-flex justify-content-between">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Career Apply'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'user_id',
            'first_name',
            'last_name',
            'mobile',
            //'email:email',
            //'job_position_id',
            //'cv_file',
            //'description',
            //'status',
            //'created_at',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CareerApply $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>

</div>