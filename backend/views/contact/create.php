<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Create Contact');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-create">
    <ul class="nav nav-tabs nav-fill bg-white pt-3" id="contactTabs" role="tablist">
        <li class="nav-item">
            <?= Html::a('ایجاد مخاطب حقیقی', ['real-contact/create'], ['class' => 'nav-link active', 'role' => 'tab', 'aria-controls' => 'real', 'aria-selected' => 'true', 'data-pjax' => '1']) ?>
        </li>
        <li class="nav-item">
            <?= Html::a('ایجاد مخاطب حقوقی', ['legal-contact/create'], ['class' => 'nav-link', 'role' => 'tab', 'aria-controls' => 'legal', 'aria-selected' => 'false', 'data-pjax' => '1']) ?>
        </li>
    </ul>
    <?php Pjax::begin(['id' => 'contactPjaxContainer']); ?>
    <?php Pjax::end(); ?>
</div>
