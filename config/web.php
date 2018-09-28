<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'pan',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'qiniu' => [
            'class' => 'Qiniu\Storage\UploadManager',
            'accessKey'    =>'jkDuEig_rM8Fd7LYVdluU0rMudBDTwFdhpqgjP1v',
            'secretKey'      =>'5i61t8LXLFYgUIjIGlMYnmFlINP6uP6wRsYnz7Cl',
            'bucket'    =>'shop',//空间名
            'baseUrl'   =>'http://omw00lxis.bkt.clouddn.com/',//下载
            'thumb'   =>'9996688PANhhgfhgfhd.',//缩图
            'foostyle'   =>'-',//缩图分隔样式-
        ],
        'curl' => [
            'class' => 'app\lib\Curl\MyCurl',
            'url'       =>'http://api.k780.com:88',
            'appkey'    =>'20001',
            'sign'      =>'817caeb0d058a5d3b993248450413f1e',
            'tempid'    =>'50926'
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.qq.com',                //每种邮箱的host配置不一样   163的host：smtp.163.com
                'username' => '1530722579@qq.com',          //发件人邮箱
                'password' => 'xxgxhyoosmtmffhi',    //授权密码不是密码 POP3/SMTP服务授权密码：nolkvasouydabaee  IMAP/SMTP服务授权密码: lpbqkckxxlrijjef
                'port' => '465',                        //这里如果使用的是QQ发送就是：465  使用163发送就改为：25
                'encryption' => 'ssl',                  //这里如果使用的是QQ发送就是：ssl  使用163发送就改为：tls
            ],
//            'messageConfig'=>[
//                'charset'=>'UTF-8',
//                'from'=>['1530722579@qq.com'=>'admin']  //发件人昵称设置 如果不设置则控制器得setForm;
//            ],

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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
    'modules' => [
        'admin' => [
            'class' => 'app\module\admin',
        ],
    ],
    'language'=>'zh-CN',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
