<?php

use common\models\City;
use common\models\Province;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var City $model */
/** @var ActiveForm $form */
?>
<div class="card">
    <?php $form = ActiveForm::begin(['id'=>'city-form']); ?>
    <div class="col-sm-12">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-12">
        <?= $form->field($model, 'province_id')->widget(Select2::class, [
            'data' => ArrayHelper::map(Province::find()->all(), 'id', 'name'),
            'size' => Select2::MEDIUM,
            'options' => ['placeholder' => Yii::t('app', 'Select Province')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);
        ?>
    </div>
    <div class="text-right">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>
