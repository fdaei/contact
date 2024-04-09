<?php

use common\models\RealContact;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Real Contacts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="real-contact-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Real Contact'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'contact_type',
            'national_id',
            'economic_code',
            'coin',
            'registration_city_id',
            'registration_province_id',
            'registration_address',
            'registration_date',
            'status',
        ],
    ]); ?>


    <?php Pjax::end(); ?>

</div>
