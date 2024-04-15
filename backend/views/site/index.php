<?php

use backend\models\User;
use backend\modules\changeLog\models\ChangeLog;
use common\models\Contact;
use common\models\ContactCategory;
use common\models\mongo\MGMediaOperations;
use common\models\mongo\OrderFeedback;
use common\models\mongo\ProductFeedback;
use common\models\Order;
use common\models\Package;
use common\models\PackageOut;
use common\models\Product;
use common\models\SurveyProduct;
use common\models\UnfairPricing;
use mobit\comment\models\Comment;
use yii\caching\TagDependency;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */

$this->title = "پنل مدیریت ";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">
        <div class="row state-overview">
            <div class="col-md-12">
                داشبورد هنوز تکمیل نشده
            </div>
        </div>
    </div>
</div>

