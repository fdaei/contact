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
    <div class="row"><div class="col-md-3">    <?= $form->field($model, 'id') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'image') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'first_name') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'last_name') ?>

</div><div class="col-md-3">    <?= $form->field($model, 'national_id') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'coin') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'birth_city_id') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'birth_province_id') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'birth_address') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'registration_date') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'status') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'summary') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'description') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'mobile_numbers') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'social_links') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'phone_numbers') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'fax_numbers') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'addresses') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'emails') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'websites') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'bank_accounts') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'cards') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'shaba_numbers') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'created_at') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'created_by') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'updated_at') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'updated_by') ?>

</div><div class="col-md-3">    <?php // echo $form->field($model, 'deleted_at') ?>

</div>    </div>    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
