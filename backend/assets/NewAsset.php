<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class NewAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [

        'js/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js',
        'js/assets/libs/jquery.repeater/jquery.repeater.min.js',
        'js/assets/libs/sparkline/sparkline.js',
        'js/app.min.js',
        'js/smooth-scroll.min.js',
        'js/landing.js',
        'js/app.init.mini-sidebar.js',
        'js/app-style-switcher.js',
        'js/waves.js',
        'js/sidebarmenu.js',
        'js/ajax-modal-popup.js',
        'js/toast.js',
        'js/custom.js',
        'js/jquery.double-keypress.js',
        'js/jquery.tagsinput.js',
        'js/product.js',
        'js/old-js.js',
        'js/order.js',
        'js/keyword.js',
        // sweetalert2 JavaScript -->
        'js/sweetalert2.all.min.js',
        'js/parsimap-tile.js',
        'js/parsimap-geocoder.js'
    ];

    public $css = [
        'css/fonts/iranSansNumber/css/style.css',
        'css/fonts/font-awesome/css/all.min.css',
        //'css/bootstrap-4/bootstrap-rtl.css',
        'css/custom.css',
        //'css/table-responsive.css',
        'css/sweetalert2.min.css',
        'css/parsimap-geocoder.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'common\assetBundles\ClipboardAsset',
    ];

}