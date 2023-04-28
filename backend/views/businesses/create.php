<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Businesses $model */

$this->title = 'کسب و کار جدید';
$this->params['breadcrumbs'][] = ['label' => 'کسب و کار ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="businesses-create custom_color">
    <?= $this->render('_form', [
        'model' => $model,
        'businessesSponsors' => $businessesSponsors,
        'businessesStatistics' => $businessesStatistics,
        'businessesServices' => $businessesServices,
        'businessesStory' => $businessesStory,
    ]) ?>
</div>
