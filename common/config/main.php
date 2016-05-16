<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager'=> [
            'class'=>'yii\rbac\DbManager',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ''=>'posts/index',
                '<action>'=>'posts/<action>',
               [
                 'pattern' => 'title/<title:[\w\W]+>' ,
                  'route' => 'posts/view',
                 'suffix' => '.html',

               ],
                '<action>'=>'categories/<action>',
                [
                    'pattern' => 'title/<title:[\w\W]+>' ,
                    'route' => 'categories/index',
                    'suffix' => '.html',

                ],


            ],
        ],
    ],
];
