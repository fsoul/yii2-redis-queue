<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['queue', 'log'],
    'controllerNamespace' => 'console\controllers',
    'modules' => [
        'debug' => [
            'class' => '\yii\debug\Module',
            'panels' => [
                'queue' => '\yii\queue\debug\Panel',
            ],
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'redis' => [
            'class' => '\yii\redis\Connection',
            'retries' => 1,
        ],
        'queue' => [
            'class' => '\yii\queue\redis\Queue',
            'redis' => 'redis',
            'channel' => 'queue',
        ],
    ],
    'params' => $params,
];
