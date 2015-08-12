<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'modules' => [
        'profile' => [
            'class' => 'frontend\modules\profile\Profile',
        ],
		'item' => [
            'class' => 'frontend\modules\item\Item',
        ],
		'loginregister' => [
            'class' => 'frontend\modules\loginregister\LoginRegister',
        ],
		'search' => [
			'class' => 'frontend\modules\search\search',
		],
			'cart' => [
			
					'class' => 'frontend\modules\cart\cart',
			
			],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
    ],
    'params' => $params,
];
