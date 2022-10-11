<?php

use common\components\Env;
use Dotenv\Dotenv;

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../common/components/Env.php');
//Loads environment variables from .env file
$dotEnv = Dotenv::createImmutable(__DIR__ . '/../../env-config');
$dotEnv->load();

defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php'
);

(new yii\web\Application($config))->run();
