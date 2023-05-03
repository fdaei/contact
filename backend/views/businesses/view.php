<?php


use common\models\Business;
use common\models\BusinessesInvestors;
use common\models\BusinessesStory;
use common\models\BusinessGallery;
use common\models\BusinessMember;
use common\models\BusinessStat;
use common\widgets\grid\GridView;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var View $this */
/** @var Business $model */
/** @var BusinessesStory $story */
/** @var BusinessGallery $gallery */
/** @var BusinessMember $services */
/** @var BusinessStat $stat */
/** @var BusinessesInvestors $investors */




$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card material-card">
    <div class="p-4">
        <?php $this->beginBlock('Business'); ?>
        <div class="m-4">
            <div class="row">
                <div class="col-10 row">
                    <div class="col-3">
                        <label for="name">Name:</label>
                        <p><?= $model->name ?></p>
                    </div>
                    <div class="col-3">
                        <label for="email">website:</label>
                        <p><?= $model->website ?></p>
                    </div>
                    <div class="col-3">
                        <label for="phone"> telegram:</label>
                        <p><?= $model->telegram ?></p>
                    </div>
                    <div class="col-3">
                        <label for="address">instagram:</label>
                        <p><?= $model->instagram ?></p>
                    </div>
                    <div class="col-3">
                        <label for="address">whatsapp:</label>
                        <p><?= $model->whatsapp ?></p>
                    </div>
                    <div class="col-3">
                        <label for="phone"> business_color:</label>
                        <p><?= $model->business_color ?></p>
                    </div>
                    <div class="col-3">
                        <label for="address">business_en_name:</label>
                        <p><?= $model->business_en_name ?></p>
                    </div>
                </div>
                <div class="col-2">
                    <img  style="height: 300px;width: 300px;" src="<?= $model->getUploadUrl('business_logo') ?>">
                </div>

                <div class="col-12">
                    <label for="address">Description Brief:</label>
                    <p><?= $model->description_brief ?></p>
                </div>
                <div class="col-12">
                    <label for="address">description:</label>
                    <p><?= $model->description ?></p>
                </div>
            </div>
            <?= Html::a(Yii::t('app', 'update'), ['/businesses/update','id'=>$model->id], ['class' => 'btn btn-info btn-rounded']) ?>
        </div>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('Statistics'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-Statistics', 'enablePushState' => false]); ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-success float-right ",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/businesses/create-statistics','id'=>$model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-business-Statistics',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                    <?php if($model->statistics): ?>
                    <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-info float-right ",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'update'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/businesses/update-statistics','id'=>$model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-business-Statistics',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                    <?php endif; ?>
                    <h3 class="float-left d-inline">آمارها</h3>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>number</th>
                </tr>
                </thead>
                <tbody>
                <?php if($model->statistics): ?>
                <?php foreach ($model->statistics as $i => $item): ?>
                    <td><?= $i ?></td>
                    <td><?= $item['title'] ?></td>
                    <td><?= $item['description'] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('services'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-services', 'enablePushState' => false]); ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left">خدمت ها</h3>
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-success float-right ",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/businesses/create-services','id'=>$model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-business-services',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                    <?php if($model->services): ?>
                    <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-info float-right ",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'update'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/businesses/update-services','id'=>$model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-business-services',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                    <?php endif; ?>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>description</th>
                </tr>
                </thead>
                <tbody>
                <?php if($model->services): ?>
                <?php foreach ($model->services as $i => $item): ?>
                    <td><?= $i ?></td>
                    <td><?= $item['title'] ?></td>
                    <td><?= $item['description'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('investors'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-investors', 'enablePushState' => false]); ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="float-left">سرمایه گذاران </h3>
                    <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                        [
                            'data-pjax' => '0',
                            'class' => "btn btn-outline-success float-right ",
                            'data-size' => 'modal-xl',
                            'data-title' => Yii::t('app', 'create'),
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-pjax',
                            'data-url' => Url::to(['/businesses-investors/create','id'=>$model->id]),
                            'data-handle-form-submit' => 1,
                            'data-show-loading' => 0,
                            'data-reload-pjax-container' => 'p-jax-business-investors',
                            'data-reload-pjax-container-on-show' => 0
                        ]) ?>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>picture</th>
                    <th>name</th>
                    <th>title</th>

                    <th class="float-right mx-5">action</th>
                </tr>
                </thead>
                <tbody>
                <?php if($investors): ?>
                <?php foreach ($investors as $i => $item): ?>
                    <td><?= $i ?></td>
                    <td><img style="width: 30px;height: 30px;" src="<?=  $item->getUploadUrl('picture') ?>" ></td>
                    <td><?= $item->title ?></td>
                    <td><?= $item->description ?></td>
                    <td class="float-right">
                        <?= Html::a(Html::tag('span', Yii::t('app', 'Delete'), ['class' => "btn btn-outline-danger ml-1 rounded-3"]), 'javascript:void(0)',
                            [
                                'title' => Yii::t('yii', 'delete'),
                                'aria-label' => Yii::t('yii', 'delete'),
                                'data-reload-pjax-container' => 'p-jax-business-member',
                                'data-pjax' => '0',
                                'data-url' => Url::to(['/businesses-investors/delete','id'=>$item->id, 'model_id'=>$model->id]),
                                'class' => " p-jax-btn",
                                'data-title' => Yii::t('yii', 'delete'),
                                'data-toggle' => 'tooltip',
                                'data-method' => ''
                            ]);?>
                        <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                            [
                                'data-pjax' => '0',
                                'class' => "btn btn-outline-success float-right ",
                                'data-size' => 'modal-xl',
                                'data-title' => Yii::t('app', 'update'),
                                'data-toggle' => 'modal',
                                'data-target' => '#modal-pjax',
                                'data-url' => Url::to(['/businesses-investors/update','id'=>$item->id, 'model_id'=>$model->id]),
                                'data-handle-form-submit' => 1,
                                'data-show-loading' => 0,
                                'data-reload-pjax-container' => 'p-jax-business-Statistics',
                                'data-reload-pjax-container-on-show' => 0
                            ]) ?>
                    </td>
                    </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('story'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-services', 'enablePushState' => false]); ?>
        <div class=" card">
            <div class="card-header">
                <h3 class="float-left">سرمایه گذاران </h3>
                <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                    [
                        'data-pjax' => '0',
                        'class' => "btn btn-outline-success float-right ",
                        'data-size' => 'modal-xl',
                        'data-title' => Yii::t('app', 'create'),
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-pjax',
                        'data-url' => Url::to(['/businesses-story/create','id'=>$model->id]),
                        'data-handle-form-submit' => 1,
                        'data-show-loading' => 0,
                        'data-reload-pjax-container' => 'p-jax-business-Statistics',
                        'data-reload-pjax-container-on-show' => 0
                    ]) ?>
            </div>
            <div class="row">

                <?php foreach ($model->businessesStory as $i => $item): ?>
                    <div class="col-sm-6 row p-5">
                        <div class="col-9 row">
                            <div class="col-sm-6">
                                <label for="email">title:</label>
                                <p><?= $item->title ?></p>
                            </div>
                            <div class="col-sm-6">
                                <label for="name">Year:</label>
                                <p><?= $item->year ?></p>
                            </div>
                        </div>
                        <div class="col-2 m-2">
                            <img style="width: 100px; height: 100px;" src="<?= $item->getUploadUrl('picture')?>" >
                        </div>
                        <div class="col-12">
                            <label> text:</label>
                            <?php foreach ($item->texts as  $ite): ?>
                            <p><?= $ite ?></p>
                            <?php endforeach; ?>
                            <div class="card-footer m-0">
                                <?= Html::a(Html::tag('span', Yii::t('app', 'Delete'), ['class' => "btn btn-outline-danger ml-1 rounded-3"]), 'javascript:void(0)',
                                    [
                                        'title' => Yii::t('yii', 'delete'),
                                        'aria-label' => Yii::t('yii', 'delete'),
                                        'data-reload-pjax-container' => 'p-jax-business-member',
                                        'data-pjax' => '0',
                                        'data-url' => Url::to(['/businesses-story/delete','id'=>$item->id, 'model_id'=>$model->id]),
                                        'class' => " p-jax-btn",
                                        'data-title' => Yii::t('yii', 'delete'),
                                        'data-toggle' => 'tooltip',
                                        'data-method' => ''
                                    ]);?>
                                <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                                    [
                                        'data-pjax' => '0',
                                        'class' => "btn btn-outline-info float-right ",
                                        'data-size' => 'modal-xl',
                                        'data-title' => Yii::t('app', 'update'),
                                        'data-toggle' => 'modal',
                                        'data-target' => '#modal-pjax',
                                        'data-url' => Url::to(['/businesses-story/update','id'=>$item->id, 'model_id'=>$model->id]),
                                        'data-handle-form-submit' => 1,
                                        'data-show-loading' => 0,
                                        'data-reload-pjax-container' => 'p-jax-business-Statistics',
                                        'data-reload-pjax-container-on-show' => 0
                                    ]) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('gallery'); ?>
        <?php Pjax::begin(['id' => 'p-jax-business-gallery', 'enablePushState' => false]); ?>
        <div class="card ">
            <div class="card-header">
                <h3 class="float-left"> گالرس عکس ها </h3>
                <?= Html::a(Yii::t('app', 'create'), "javascript:void(0)",
                    [
                        'data-pjax' => '0',
                        'class' => "btn btn-outline-success float-right ",
                        'data-size' => 'modal-xl',
                        'data-title' => Yii::t('app', 'create'),
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-pjax',
                        'data-url' => Url::to(['/businesses/pic-create','id'=>$model->id]),
                        'data-handle-form-submit' => 1,
                        'data-show-loading' => 0,
                        'data-reload-pjax-container' => 'p-jax-business-Statistics',
                        'data-reload-pjax-container-on-show' => 0
                    ]) ?>
                <?php if($model->pic_main_desktop || $model->pic_main_mobile || $model->pic_small1_desktop || $model->pic_small1_mobile ||
                $model->pic_small2_desktop	 || $model->pic_small2_mobile ): ?>
                <?= Html::a(Yii::t('app', 'update'), "javascript:void(0)",
                    [
                        'data-pjax' => '0',
                        'class' => "btn btn-outline-info float-right ",
                        'data-size' => 'modal-xl',
                        'data-title' => Yii::t('app', 'create'),
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-pjax',
                        'data-url' => Url::to(['/businesses/pic-update','id'=>$model->id]),
                        'data-handle-form-submit' => 1,
                        'data-show-loading' => 0,
                        'data-reload-pjax-container' => 'p-jax-business-Statistics',
                        'data-reload-pjax-container-on-show' => 0
                    ]) ?>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس اصلی در دسکتاپ</label>
                        <img src="<?= $model->getUploadUrl('pic_main_desktop') ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس اصلی در موبایل</label>
                        <img src="<?= $model->getUploadUrl('pic_main_mobile') ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک در دسکتاپ</label>
                        <img src="<?= $model->getUploadUrl('pic_small1_desktop') ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک در موبایل</label>
                        <img src="<?= $model->getUploadUrl('pic_small1_mobile') ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک دیگر در دسکتاپ</label>
                        <img src="<?= $model->getUploadUrl('pic_small2_desktop') ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class=" card my-3">
                        <label class="card-header">عکس کوچیک دیگر در موبایل</label>
                        <img src="<?= $model->getUploadUrl('pic_small2_mobile') ?>">
                    </div>
                </div>
            </div>
        </div>
        <?php Pjax::end(); ?>
        <?php $this->endBlock(); ?>
        <?php echo Tabs::Widget([
            'items' => [
                [
                    'label' => Yii::t('app', 'Business'),
                    'content' => $this->blocks['Business'],
                    'active' => true,
                ],
                [
                    'label' => Yii::t('app', 'Statistics'),
                    'content' => $this->blocks['Statistics'],
                ],
                [
                    'label' => Yii::t('app', 'services'),
                    'content' => $this->blocks['services'],
                ],
                [
                    'label' => Yii::t('app', 'investors'),
                    'content' => $this->blocks['investors'],
                ],
                [
                    'label' => Yii::t('app', 'story'),
                    'content' => $this->blocks['story'],
                ],
                [
                    'label' => Yii::t('app', 'gallery'),
                    'content' => $this->blocks['gallery'],
                ],

            ]
        ]); ?>
    </div>
</div>
