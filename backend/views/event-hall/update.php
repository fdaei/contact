<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EventHall $model */

$this->title = Yii::t('app', 'Update Event Hall: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Halls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="event-hall-update">
    <div class="card material-card">
        <div class="card-header">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
<script>
    window.addEventListener('load', (eventhall) => {
        createMap("eventhall",<?=$model->latitude?>,<?=$model->longitude?>);
    });
</script>