<?php

use common\components\Env;

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => Env::get('DB_DSN'),
            'username' => Env::get('DB_USERNAME'),
            'password' => Env::get('DB_PASSWORD'),
            'charset' => Env::get('DB_CHARSET', 'utf8'),
            'tablePrefix' => Env::get('DB_TABLE_PREFIX'),
        ],
    ]
];