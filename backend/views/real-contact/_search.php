<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RealContactSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="real-contact-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'national_id') ?>

    <?php // echo $form->field($model, 'coin') ?>

    <?php // echo $form->field($model, 'birth_city_id') ?>

    <?php // echo $form->field($model, 'birth_province_id') ?>

    <?php // echo $form->field($model, 'birth_address') ?>

    <?php // echo $form->field($model, 'registration_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'mobile_numbers') ?>

    <?php // echo $form->field($model, 'social_links') ?>

    <?php // echo $form->field($model, 'phone_numbers') ?>

    <?php // echo $form->field($model, 'fax_numbers') ?>

    <?php // echo $form->field($model, 'addresses') ?>

    <?php // echo $form->field($model, 'emails') ?>

    <?php // echo $form->field($model, 'websites') ?>

    <?php // echo $form->field($model, 'bank_accounts') ?>

    <?php // echo $form->field($model, 'cards') ?>

    <?php // echo $form->field($model, 'shaba_numbers') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
