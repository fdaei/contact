<?php

use backend\models\EventTimes;
use common\models\Businesses;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/** @var ActiveForm $form */
/** @var Businesses $model */
/** @var EventTimes[] $EventTimes */

$form = ActiveForm::begin(['id' => 'event_form']); // Start the ActiveForm
?>
<div class="card card-body">
    <div class='col-md-12 kohl' style="">
        <div class="panel-body ">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper2', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items-time', // required: css class selector
                'widgetItem' => '.item-time', // required: css class
                'limit' => 20, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item_time', // css class
                'deleteButton' => '.remove-item_time', // css class
                'model' => $EventTimes[0],
                'formId' => 'event_form',
                'formFields' => [
                    'start',
                    'end'
                ],
            ]); ?>
            <div class="container-items-time"><!-- widgetContainer -->
                <?php foreach ($EventTimes as $i => $time): ?>
                    <div class="item-time panel panel-default"><!-- widgetBody -->
                        <div>
                            <div class="pull-right">
                                    <button type="button" class="remove-item_time btn btn-danger btn-xs">حذف</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (! $time->isNewRecord) {
                                echo Html::activeHiddenInput($time, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($time, "[{$i}]start")->textInput(['maxlength' => true,'data-jdp'=>true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($time, "[{$i}]end")->textInput(['maxlength' => true,'data-jdp'=>true]) ?>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="add-item_time btn btn-success btn-xs">زمان جدید</button>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
</div>
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?> <!-- Add a submit button -->
<?php ActiveForm::end(); // End the ActiveForm ?>

<?php
$script = <<< JS
    
        jalaliDatepicker.startWatch({
            time: true,
            hasSecond: false,
            zIndex:2000,
        })
    
JS;

$this->registerJs($script, \yii\web\View::POS_END)
?>
