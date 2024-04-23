<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\City $model */
?>
<div class="city-update">
    <div class="card ">
        <div>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>