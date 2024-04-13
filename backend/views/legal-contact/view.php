<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\LegalContact $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Legal Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="legal-contact-view">
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
                        'id',
            'logo',
            'name',
            'national_id',
            'economic_code',
            'coin',
            'registration_city_id',
            'registration_province_id',
            'registration_address',
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
    </div>
