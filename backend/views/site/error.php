<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */


$this->title = $name;
?>
<div class="site-error text-left">

    <h1 class="text-center dir-ltr"><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <?= Yii::t('app', 'The above error occurred while the Web server was processing your request.') ?>
    </p>
    <p>
        <?= Yii::t('app', 'Please contact us if you think this is a server error. Thank you.') ?>
    </p>
    <div class="row">
        <div class="col-md-12 mt-2">
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['/site/index'], ['class' => 'btn btn-info btn-block', 'title' => 'برگشت به صفحه نخست']) ?>
        </div>
        <div class="col-md-12 mt-2">
            <?= Html::a('<i class="fas fa-power-off"></i> ' . Yii::t('app', 'Logout'), ['/site/logout'], ['class' => 'btn btn-danger btn-block', 'data-method' => "post", 'title' => 'خروج از سیستم']) ?>
        </div>
    </div>
</div>
