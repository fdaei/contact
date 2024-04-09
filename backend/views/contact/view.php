<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\RealContact $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Real Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="real-contact-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'image',
            'first_name',
            'last_name',
            'national_id',
            'coin',
            'birth_city_id',
            'birth_province_id',
            'birth_address',
            'registration_date',
            'status',
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
