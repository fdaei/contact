<?php

use common\models\Addresses;
use common\models\City;
use common\models\MobileNumber;
use common\models\Province;
use common\models\RealContact;
use common\models\Tag;
use kartik\file\FileInput;
use kartik\select2\Select2;
use sadi01\dateRangePicker\dateRangePicker;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RealContact $model */
/** @var yii\widgets\ActiveForm $form */
/** @var common\models\MobileNumber $mobileNumbers */
/** @var common\models\FaxNumbers $faxNumbers */
/** @var common\models\PhoneNumbers $phoneNumbers */
/** @var common\models\Addresses $addresses */
/** @var common\models\BankAccounts $bankAccounts */
/** @var common\models\Cards $cards */
/** @var common\models\Emails $emails */
/** @var common\models\ShabaNumbers $shabaNumbers */
/** @var common\models\SocialLink $socialLink */
/** @var common\models\Websites $websites */
/** @var common\models\RealContactFile $uploadFile */

?>

<div class="real-contact-form">

    <?php
    $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row justify-content-center">
        <div class='col-md-3'>
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'national_code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'coin')->input('number') ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'birth_city_id')->widget(Select2::class, [
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
            <?= $form->field($model, 'birth_province_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(Province::find()->all(), 'id', 'name'),
                'size' => Select2::MEDIUM,
                'options' => ['placeholder' => Yii::t('app', 'Select Province')],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'birth_address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3'>
            <?= $form->field($model, 'registration_date')->widget(dateRangePicker::classname(), [
                'options' => [
                    'locale' => [
                        'format' => 'jYYYY/jMM/jDD',
                    ],
                    'drops' => 'down',
                    'opens' => 'right',
                    'jalaali' => true,
                    'showDropdowns' => true,
                    'language' => 'fa',
                    'singleDatePicker' => true,
                    'useTimestamp' => true,
                    'timePicker' => false,
                    'timePickerSeconds' => true,
                    'timePicker24Hour' => true
                ],
                'htmlOptions' => [
                    'id' => 'registration_date',
                    'class' => 'form-control',
                ]
            ]); ?>
        </div>
        <div class='col-md-6'>
            <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>
        </div>
        <div class='col-md-6'>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class='col-md-12'>
            <div class="businesses-story-form">
                <div class="row bg-white p-3 rounded my-3">
                    <div class="card card-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper4',
                            'widgetBody' => '.container-items',
                            'widgetItem' => '.item-addresses',
                            'limit' => 20,
                            'min' => 1,
                            'insertButton' => '.add-item-addresses',
                            'deleteButton' => '.remove-item-addresses',
                            'model' => $addresses[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'mobile_title',
                                'mobile_number'
                            ],
                        ]); ?>
                        <div class="container-items">
                            <div>
                                <button type="button" class="add-item-addresses btn  btn-xs float-right  bg-primary text-white">
                                    آدرس جدید
                                </button>
                            </div>
                            <?php foreach ($addresses as $i => $address): ?>
                                <div class="item-addresses panel panel-default" style="padding-right: 0px">
                                    <div class="panel-body">
                                        <?php
                                        if (!$address->isNewRecord) {
                                            echo Html::activeHiddenInput($address, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?= $form->field($address, "[{$i}]address")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <?= $form->field($address, "[{$i}]postal_code")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class='col-md-4'>
                                                <?= $form->field($address, 'city_id')->widget(Select2::class, [
                                                    'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
                                                    'size' => Select2::MEDIUM,
                                                    'options' => ['placeholder' => Yii::t('app', 'Select Province')],
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                    ],
                                                ]);
                                                ?>
                                            </div>
                                            <div class='col-md-4'>
                                                <?= $form->field($address, 'province_id')->widget(Select2::class, [
                                                    'data' => ArrayHelper::map(Province::find()->all(), 'id', 'name'),
                                                    'size' => Select2::MEDIUM,
                                                    'options' => ['placeholder' => Yii::t('app', 'Select Province')],
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                    ],
                                                ]);
                                                ?>
                                            </div>
                                            <div class='col-md-4'>
                                                <?= $form->field($address, "[{$i}]address_type")->dropDownList(Addresses::itemAlias('AddressType'), ['prompt' => Yii::t('app', 'Select address')]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <button type="button" class="remove-item-addresses btn  btn-xs float-right  btn-danger text-white">
                                           حدف آدرس
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class="businesses-story-form">
                <div class="row bg-white p-3 rounded my-3">
                    <div class="card card-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper1',
                            'widgetBody' => '.container-items',
                            'widgetItem' => '.item-statistics',
                            'limit' => 20,
                            'min' => 1,
                            'insertButton' => '.add-item-statistics',
                            'deleteButton' => '.remove-item-statistics',
                            'model' => $mobileNumbers[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'mobile_title',
                                'mobile_number'
                            ],
                        ]); ?>
                        <div class="container-items">
                            <div>
                                <button type="button" class="add-item-statistics btn  btn-xs float-right  bg-primary text-white">
                                    شماره موبایل جدید
                                </button>
                            </div>
                            <?php foreach ($mobileNumbers as $i => $text): ?>
                                <div class="item-statistics panel panel-default" style="padding-right: 0px">
                                    <div class="panel-body">
                                        <?php
                                        if (!$text->isNewRecord) {
                                            echo Html::activeHiddenInput($text, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <?= $form->field($text, "[{$i}]mobile_title")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?= $form->field($text, "[{$i}]mobile_number")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?= $form->field($text, "[{$i}]message_link")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class='col-md-3'>
                                                <?= $form->field($text, "[{$i}]mobile_type")->dropDownList(MobileNumber::itemAlias('SocialNetworks'), ['prompt' => Yii::t('app', 'Select Social')]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <button type="button" class="remove-item-statistics btn  btn-xs float-right  btn-danger text-white">
                                                حذف شماره موبایل
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class="businesses-story-form">
                <div class="row bg-white p-3 rounded my-3">
                    <div class="card card-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper2',
                            'widgetBody' => '.container-items',
                            'widgetItem' => '.item-faxNumbers',
                            'limit' => 20,
                            'min' => 1,
                            'insertButton' => '.add-item-faxNumbers',
                            'deleteButton' => '.remove-item-faxNumbers',
                            'model' => $faxNumbers[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'fax_number',
                            ],
                        ]); ?>
                        <div class="container-items">
                            <div>
                                <button type="button" class="add-item-faxNumbers btn  btn-xs float-right  bg-primary text-white">
                                    شماره فکس جدید
                                </button>
                            </div>
                            <?php foreach ($faxNumbers as $i => $fax): ?>
                                <div class="item-faxNumbers panel panel-default">
                                    <div class="panel-body">
                                        <?php
                                        if (!$fax->isNewRecord) {
                                            echo Html::activeHiddenInput($fax, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?= $form->field($fax, "[{$i}]fax_number")->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <button type="button" class="remove-item-faxNumbers btn  btn-xs float-right  btn-danger text-white">
                                            حذف شماره فکس
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class="businesses-story-form ">
                <div class="row bg-white p-3 rounded my-3">
                    <div class="card card-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper3',
                            'widgetBody' => '.container-items',
                            'widgetItem' => '.item-phoneNumbers',
                            'limit' => 20,
                            'min' => 1,
                            'insertButton' => '.add-item-phoneNumbers',
                            'deleteButton' => '.remove-item-phoneNumbers',
                            'model' => $phoneNumbers[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'phone_number',
                            ],
                        ]); ?>
                        <div class="container-items">
                            <div>
                                <button type="button" class="add-item-phoneNumbers btn  btn-xs float-right bg-primary text-white">
                                   جدید شماره ثابت
                                </button>
                            </div>
                            <?php foreach ($phoneNumbers as $i => $number): ?>
                                <div class="item-phoneNumbers panel panel-default">
                                    <div class="panel-body">
                                        <?php
                                        if (!$number->isNewRecord) {
                                            echo Html::activeHiddenInput($number, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?= $form->field($number, "[{$i}]phone_number")->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <button type="button" class="remove-item-phoneNumbers btn  btn-xs float-right btn-danger text-white">
                                                حذف شماره ثابت
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class="businesses-story-form">
                <div class="row bg-white p-3 rounded my-3">
                    <div class="card card-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper5',
                            'widgetBody' => '.container-items',
                            'widgetItem' => '.item-bankAccounts',
                            'limit' => 20,
                            'min' => 1,
                            'insertButton' => '.add-item-bankAccounts',
                            'deleteButton' => '.remove-item-bankAccounts',
                            'model' => $bankAccounts[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'bank_accounts',
                            ],
                        ]); ?>
                        <div class="container-items">
                            <div>
                                <button type="button" class="add-item-bankAccounts btn  btn-xs float-right  bg-primary text-white">
                                    شماره حساب جدید
                                </button>
                            </div>
                            <?php foreach ($bankAccounts as $i => $accounts): ?>
                                <div class="item-bankAccounts panel panel-default" style="padding-right: 0px">
                                    <div class="panel-body">
                                        <?php
                                        if (!$accounts->isNewRecord) {
                                            echo Html::activeHiddenInput($accounts, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?= $form->field($accounts, "[{$i}]bank_accounts")->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <button type="button" class="remove-item-bankAccounts btn  btn-xs float-right  btn-danger text-white">
                                                حذف شماره حساب
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class="businesses-story-form">
                <div class="row bg-white p-3 rounded my-3">
                    <div class="card card-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper6',
                            'widgetBody' => '.container-items',
                            'widgetItem' => '.item-cards',
                            'limit' => 20,
                            'min' => 1,
                            'insertButton' => '.add-item-cards',
                            'deleteButton' => '.remove-item-cards',
                            'model' => $cards[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'card',
                            ],
                        ]); ?>
                        <div class="container-items">
                            <div>
                                <button type="button" class="add-item-cards btn  btn-xs float-right  bg-primary text-white">
                                    شماره کارت جدید
                                </button>
                            </div>
                            <?php foreach ($cards as $i => $card): ?>
                                <div class="item-cards panel panel-default" style="padding-right: 0px">
                                    <div class="panel-body">
                                        <?php
                                        if (!$card->isNewRecord) {
                                            echo Html::activeHiddenInput($card, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?= $form->field($card, "[{$i}]card")->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <button type="button" class="remove-item-cards btn  btn-xs float-right  btn-danger text-white">
                                                حذف شماره کارت
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class="businesses-story-form">
                <div class="row bg-white p-3 rounded my-3">
                    <div class="card card-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper9',
                            'widgetBody' => '.container-items',
                            'widgetItem' => '.item-socialLink',
                            'limit' => 20,
                            'min' => 1,
                            'insertButton' => '.add-item-socialLink',
                            'deleteButton' => '.remove-item-socialLink',
                            'model' => $socialLink[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'mobile_title',
                                'mobile_number'
                            ],
                        ]); ?>
                        <div class="container-items">
                            <div>
                                <button type="button" class="add-item-socialLink btn  btn-xs float-right  bg-primary text-white">
                                    شبکه اجتماعی جدید
                                </button>
                            </div>
                            <?php foreach ($socialLink as $i => $link): ?>
                                <div class="item-socialLink panel panel-default" style="padding-right: 0px">
                                    <div class="panel-body">
                                        <?php
                                        if (!$link->isNewRecord) {
                                            echo Html::activeHiddenInput($link, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?= $form->field($link, "[{$i}]social_link")->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <button type="button" class="remove-item-socialLink btn  btn-xs float-right  btn-danger text-white">
                                                حذف شبکه اجتماعی
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class="businesses-story-form">
                <div class="row bg-white p-3 rounded my-3">
                    <div class="card card-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper8',
                            'widgetBody' => '.container-items',
                            'widgetItem' => '.item-shabaNumbers',
                            'limit' => 20,
                            'min' => 1,
                            'insertButton' => '.add-item-shabaNumbers',
                            'deleteButton' => '.remove-item-shabaNumbers',
                            'model' => $shabaNumbers[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'mobile_title',
                                'mobile_number'
                            ],
                        ]); ?>
                        <div class="container-items">
                            <div>
                                <button type="button" class="add-item-shabaNumbers btn  btn-xs float-right  bg-primary text-white">
                                    شماره شبا جدید
                                </button>
                            </div>
                            <?php foreach ($shabaNumbers as $i => $number): ?>
                                <div class="item-shabaNumbers panel panel-default" style="padding-right: 0px">
                                    <div class="panel-body">
                                        <?php
                                        if (!$number->isNewRecord) {
                                            echo Html::activeHiddenInput($number, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?= $form->field($number, "[{$i}]shaba_numbers")->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <button type="button" class="remove-item-statistics btn  btn-xs float-right  btn-danger text-white">
                                                حذف شماره شبا
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class="businesses-story-form">
                <div class="row bg-white p-3 rounded my-3">
                    <div class="card card-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper7',
                            'widgetBody' => '.container-items',
                            'widgetItem' => '.item-emails',
                            'limit' => 20,
                            'min' => 1,
                            'insertButton' => '.add-item-emails',
                            'deleteButton' => '.remove-item-emails',
                            'model' => $emails[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'mobile_title',
                                'mobile_number'
                            ],
                        ]); ?>
                        <div class="container-items">
                            <div>
                                <button type="button" class="add-item-emails btn  btn-xs float-right  bg-primary text-white">
                                    ایمیل جدید
                                </button>
                            </div>
                            <?php foreach ($emails as $i => $email): ?>
                                <div class="item-emails panel panel-default" style="padding-right: 0px">
                                    <div class="panel-body">
                                        <?php
                                        if (!$email->isNewRecord) {
                                            echo Html::activeHiddenInput($email, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?= $form->field($email, "[{$i}]email")->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <button type="button" class="remove-item-emails btn  btn-xs float-right  btn-danger text-white">
                                                حذف ایمیل
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class="businesses-story-form">
                <div class="row bg-white p-3 rounded my-3">
                    <div class="card card-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper10',
                            'widgetBody' => '.container-items',
                            'widgetItem' => '.item-websites',
                            'limit' => 20,
                            'min' => 1,
                            'insertButton' => '.add-item-websites',
                            'deleteButton' => '.remove-item-websites',
                            'model' => $websites[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'mobile_title',
                                'mobile_number'
                            ],
                        ]); ?>
                        <div class="container-items">
                            <div>
                                <button type="button" class="add-item-websites btn  btn-xs float-right  bg-primary text-white">
                                    آدرس جدید
                                </button>
                            </div>
                            <?php foreach ($websites as $i => $website): ?>
                                <div class="item-websites panel panel-default" style="padding-right: 0px">
                                    <div class="panel-body">
                                        <?php
                                        if (!$website->isNewRecord) {
                                            echo Html::activeHiddenInput($website, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?= $form->field($website, "[{$i}]website")->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <button type="button" class="remove-item-websites btn  btn-xs float-right  btn-danger text-white">
                                                حذف آدرس
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-6'>
            <div class="businesses-story-form">
                <div class="row">
                    <div class="card card-body">
                        <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper11',
                            'widgetBody' => '.container-items',
                            'widgetItem' => '.item-websites',
                            'limit' => 20,
                            'min' => 1,
                            'insertButton' => '.add-item-websites',
                            'deleteButton' => '.remove-item-websites',
                            'model' => $uploadFile[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'file_name',
                                'file_path'
                            ],
                        ]); ?>
                        <div class="container-items">
                            <div>
                                <button type="button" class="add-item-websites btn  btn-xs float-right  bg-primary text-white">
                                    فایل جدید
                                </button>
                            </div>
                            <?php foreach ($uploadFile as $i => $file): ?>
                                <div class="item-websites panel panel-default" style="padding-right: 0px">
                                    <div class="panel-body">
                                        <?php
                                        if (!$file->isNewRecord) {
                                            echo Html::activeHiddenInput($file, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?= $form->field($file, "[{$i}]file_name")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-sm-12">
                                                <?= $form->field($file, "[{$i}]file_path")->fileInput() ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <button type="button" class="remove-item-websites btn  btn-xs float-right  btn-danger text-white">
                                                حذف فایل
                                            </button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-6'>

            <?= $form->field($model, 'contact_tag')->widget(Select2::class, [
                'initValueText' => $model->isNewRecord ? $tagSelected : ArrayHelper::map($searchedTags, 'tag_id', 'name'),
                'options' => [
                    'multiple' => true,
                    'placeholder' => 'یک یا چند تگ را انتخاب نمایید...',
                    'dir' => 'rtl',
                    'data-id' => $model->id,
                    'data-tags' => $model->isNewRecord ? $tagSelected : ArrayHelper::map($searchedTags, 'tag_id', 'type'),
                    'data-tags-name' => $model->isNewRecord ? $tagSelected : ArrayHelper::map($searchedTags, 'tag_id', 'name'),
                    'data-tags-type' => Tag::itemAlias('TypeClass'),
                    'class' => 'form-control TagInput',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'closeOnSelect' => false,
                    'minimumInputLength' => 2,
                    'ajax' => [
                        'url' => Url::to(['/tag/list', 'type' => null]),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {query:params.term}; }'),
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function (data) { return (data.html != undefined) ? data.text : null; }'),
                    'templateSelection' => new JsExpression('function (data)
                    {
                        var selectElement = $(data.element).parent();
                        if(selectElement.data("tags")[data.id] != undefined){
                            var type = selectElement.data("tags")[data.id];
                            var typeClass = $(".TagInput").data("tags-type")[type];
                            return "<span class=\"text-bold badge badge-" + typeClass + "\">" + data.text + "</span>";
                        }else{
                            return data.text;
                        }
                    }'),
                ]
            ]); ?>
        </div>
        <div class='col-md-6 mt-5'>
            <?= $form->field($model, 'status')->dropDownList(RealContact::itemAlias('Status'), ['prompt' => Yii::t('app', 'Select Status')]) ?>
        </div>
        <div class="col-md-6 text-center">
            <?= $form->field($model, 'image')->widget(FileInput::class, [
                'name' => 'attachment_3',
                'options' => ['accept' => 'image/*'],
            ]) ?>
        </div>
    </div>
    <div class="form-group mb-0 card-footer d-flex justify-content-between">
        <div>
            <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
