<?php


$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
                ['pattern' => 'customers', 'route' => 'customer/index', 'verb' => ['GET']],
                ['pattern' => 'customers', 'route' => 'customer/create-from-array', 'verb' => ['POST']],
                ['pattern' => 'customers/json', 'route' => 'customer/create-from-json', 'verb' => ['POST']],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=mysql;dbname=web_service_advanced',
            'username' => $params['db']['username'],
            'password' => $params['db']['password'],
            'charset' => 'utf8',
        ],
    ],
    'container' => [
        'singletons' => [
            'backend\components\Booking\BookingInterface' => ['class' => 'backend\components\Booking\BookingService'],
            
            'SpotifyGuzzleClient' => [
                ['class' => '\GuzzleHttp\Client'],
                [
                    ['base_uri' => $params['base_uri']]
                ],
            ],
            'GuzzleHttp\ClientInterface' => 'SpotifyGuzzleClient',

            'JmsSerializer' => function () {
                return JMS\Serializer\SerializerBuilder::create()->build();
            },
            'JMS\Serializer\SerializerInterface' => 'JmsSerializer',

            'Symfony\Component\Validator\Validator\ValidatorInterface' => function () {
                return Symfony\Component\Validator\Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
            },

            'Psr\Log\LoggerInterface' => function () {
                return \backend\helper\Monolog\MonologBuilder::build();
            },

            'Twig\Environment' => function () {
                $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../templates/');
                $twig = new \Twig\Environment($loader,
                    [
                        'cache' => __DIR__.'/../runtime/twig/compilation_cache',
                        'debug' => true,
                    ]
                );
                $twig->addExtension(new \Twig\Extension\DebugExtension());

                return $twig;
            },

            'backend\utils\TransformData\TransformDataInterface' => [
                ['class' => 'backend\utils\TransformData\TransformRequestForm'],
                [
                    \yii\di\Instance::of('JmsSerializer'),
                    \yii\di\Instance::of('Symfony\Component\Validator\Validator\ValidatorInterface'),
                ]
            ],
        ],
    ],
    'params' => $params,
];
