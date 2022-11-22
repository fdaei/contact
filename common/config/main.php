<?php

use common\components\Env;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@inceRoot' => Env::get('INCE_ROOT'),
        '@inceWeb' => Env::get('INCE_WEB'),
        '@cdnRoot' => Env::get('CDN_ROOT'),
        '@cdnWeb' => Env::get('CDN_WEB')
    ],
    'language' => 'fa-IR',
    'timeZone' => 'Asia/Tehran',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'fa-items',
                    'fileMap' => [
                        'common' => 'common.php',
                        'common/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            //'class' => 'yii\web\Session',
        ],
        'formatter' => [
            'locale' => 'fa_IR@c\alendar=persian',
            'calendar' => 0,
            'dateFormat' => 'yyyy/MM/dd',
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            'currencyCode' => 'IRR',
            'numberFormatterSymbols' => [8 => ' '],
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
            //'class' => 'yii\caching\FileCache',
        ],
        'pdate' => [
            'class' => 'common\components\Pdate'
        ],
    ],
];