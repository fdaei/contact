<?php

use backend\assets\NewAsset;
use yii\bootstrap4\Modal;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


NewAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html dir="rtl"  lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
             style="background:url(<?= Yii::getAlias('@web') ?>/img/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box">
                <?= $content ?>
            </div>
        </div>
    </div>

        <?php
        Modal::begin([
            'headerOptions' => ['id' => 'modalPjaxHeader'],
            'id' => 'modal-pjax',
            'bodyOptions' => [
                'id' => 'modalPjaxContent',
                'class' => 'p-3',
                'data' => ['show-preloader' => 0]
            ],
            'options' => ['tabindex' => false]
        ]); ?>
        <div class="text-center">
            <div class="spinner-border text-info" role="status" style="width: 3rem; height: 3rem;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <?php Modal::end(); ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>