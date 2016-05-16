<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
$baseUrl=str_replace('/web','',(new \yii\web\Request)->baseUrl);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [

        'user' => [
            'identityClass' => 'common\models\Users',
            'enableAutoLogin' => true,
          //  'loginUrl' => ['site/login'],
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
        


        'urlManager'=>[
          'baseUrl'=>$baseUrl,
           'enablePrettyUrl'=> true,
           'showScriptName'=> false,
           'rules'=> require_once (__DIR__ . '/routes.php'),
      ],
    ],



    'params' => $params,
];
