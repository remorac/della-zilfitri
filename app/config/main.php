<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'profile-matching',
    'name' => 'Simulasi',
    'basePath' => dirname(__DIR__),
    'language' => 'id',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\controllers',
    'modules' => [
        'acf' => ['class' => 'mdm\admin\Module'],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-app',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-app', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the app
            'name' => 'advanced-app',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // 'cache' => 'cache',
            // 'defaultRoles' => ['superuser'],
        ],
        'view',
        'formatter' => [
            'nullDisplay' => '',
        ],
    ],
    'params' => $params,
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'acf/*',
            // 'debug/*',
            '*',
        ]
    ],
];
