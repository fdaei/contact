<?php

use common\models\City;
use common\models\Province;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var Province $model */
/** @var ActiveForm $form */
?>
<div class="card">
    <?php $form = ActiveForm::begin(['id'=>'province-form']); ?>
    <div class="col-sm-12">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="text-right">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

