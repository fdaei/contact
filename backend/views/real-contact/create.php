<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\RealContact $model */

$this->title = Yii::t('app', 'Create Real Contact');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Real Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="real-contact-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
