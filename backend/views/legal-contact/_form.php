<?php

use common\models\City;
use common\models\LegalContact;
use common\models\Province;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\LegalContact $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="legal-contact-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center">
        <div class='col-md-8'> <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'national_code')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'economic_code')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'coin')->input('number') ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'registration_city_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
                'size' => Select2::MEDIUM,
                'options' => ['placeholder' => Yii::t('app', 'Select Province')],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'registration_province_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(Province::find()->all(), 'id', 'name'),
                'size' => Select2::MEDIUM,
                'options' => ['placeholder' => Yii::t('app', 'Select Province')],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>
        </div>
        <div class='col-md-8'> <?= $form->field($model, 'registration_address')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'registration_date')->textInput() ?>

        </div>
        <div class='col-md-8'>
            <?= $form->field($model, 'status')->dropDownList(LegalContact::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'mobile_numbers')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'social_links')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'phone_numbers')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'fax_numbers')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'addresses')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'emails')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'websites')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'bank_accounts')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'cards')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'shaba_numbers')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'created_at')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'created_by')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'updated_at')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'updated_by')->textInput() ?>

        </div>
        <div class='col-md-8'> <?= $form->field($model, 'deleted_at')->textInput() ?>

        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div class="col-md-10 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
