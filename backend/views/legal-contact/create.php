<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LegalContact $model */
?>
<div class="contact-create">
    <ul class="nav nav-tabs nav-fill bg-white pt-3" id="contactTabs" role="tablist">
        <li class="nav-item active">
            <?= Html::a('ایجاد مخاطب حقیقی', ['real-contact/create'], ['class' => 'nav-link active', 'aria-controls' => 'real', 'aria-selected' => 'false', 'data-pjax' => '1']) ?>
        </li>
        <li class="nav-item">
            <?= Html::a('ایجاد مخاطب حقوقی', ['legal-contact/create'], ['class' => 'nav-link', 'aria-controls' => 'legal', 'aria-selected' => 'true', 'data-pjax' => '1']) ?>
        </li>
    </ul>
</div>
<div class="legal-contact-create card material-card">
    <div class="card-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
