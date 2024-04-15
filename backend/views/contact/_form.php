<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RealContact $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="real-contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'national_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coin')->textInput() ?>

    <?= $form->field($model, 'birth_city_id')->textInput() ?>

    <?= $form->field($model, 'birth_province_id')->textInput() ?>

    <?= $form->field($model, 'birth_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registration_date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'mobile_numbers')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'social_links')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone_numbers')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fax_numbers')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'addresses')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'emails')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'websites')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bank_accounts')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cards')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'shaba_numbers')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
