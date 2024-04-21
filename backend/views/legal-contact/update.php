<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\RealContact $model */
/** @var common\models\MobileNumber $mobileNumbers */
/** @var common\models\FaxNumbers $faxNumbers */
/** @var common\models\PhoneNumbers $phoneNumbers */
/** @var common\models\Addresses $addresses */
/** @var common\models\BankAccounts $bankAccounts */
/** @var common\models\Cards $cards */
/** @var common\models\Emails $emails */
/** @var common\models\ShabaNumbers $shabaNumbers */
/** @var common\models\SocialLink $socialLink */
/** @var common\models\Websites $websites */
/** @var common\models\RealContactFile $uploadFile */

$this->title = "ویرایش مخاطب حقوقی";
?>
<div class="real-contact-update">
    <div class="card material-card">
        <div class="card-header">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
                'mobileNumbers' =>  $mobileNumbers,
                'faxNumbers' =>  $faxNumbers,
                'phoneNumbers' =>  $phoneNumbers,
                'addresses' =>  $addresses,
                'bankAccounts' =>  $bankAccounts,
                'cards' => $cards,
                'emails'=> $emails,
                'shabaNumbers' =>  $shabaNumbers,
                'socialLink' =>  $socialLink,
                'websites' =>  $websites,
                'searchedTags' => $searchedTags,
                'tagSelected' => $tagSelected,
                'uploadFile'=>$uploadFile,
            ]) ?>
        </div>
    </div>
</div>