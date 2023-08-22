<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MentorsAdviceRequest $model */

$this->title = Yii::t('app', 'Create Mentors Advice Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mentors Advice Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mentors-advice-request-create card material-card">
    <div class="card-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>