<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'kowop',

    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),

    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'kowop123',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1', '*'),
        ),
        'iwi' => array(
            'class' => 'application.extensions.iwi.IwiComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            //'params'=>array('directory'=>'C:/ImageMagick'),
        ),
        'hybridauth' => array(
            'baseUrl' => 'http://' . $_SERVER['SERVER_NAME'] . '/hybridauth',
            'withYiiUser' => false, // Set to true if using yii-user
            "providers" => array(
                /*"Google" => array(
                    "enabled" => true,
                    "keys" => array("id" => "346522202623.apps.googleusercontent.com", "secret" => "n1mpAUFpf4oOos1dFqsfEuJc"),
                    "scope" => ""
                ),*/
                "Facebook" => array(
                    "enabled" => true,
                    //"keys" => array("id" => "126428637531867", "secret" => "732e1160e96faa0cd5bf4c6e43607dd1"),
                    "keys" => array("id" => "552165668142008", "secret" => "d0dcaaad8b6545a7154ac4384e1320ff"),
                    "scope" => "email,user_about_me,publish_stream",
                    "display" => ""
                ),
/*                "Twitter" => array(
                    "enabled" => true,
                    "keys" => array("key" => "VHPB3OgTBtZCvvMGBB8iQ", "secret" => "MRXO9L9Yj4LCCR9cJFZjAXgulPq40O1OFXn3akagbM")
                )*/
            )
        ),
    ),

    'aliases' => array(
        'xupload' => 'application.extensions.xupload'
    ),

    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
            'showScriptName' => false,
            'caseSensitive' => false,
        ),

        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=kowop',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'kowop123!',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info',
                    'categories' => 'BalancedCallback',
                    'logFile' => 'balancedCallback.log',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info',
                    'categories' => 'Email',
                    'logFile' => 'email.log',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
					'class'=>'CWebLogRoute',
				),
                */
            ),
        ),
        'clientScript' => array(
            'scriptMap' => array(
                'jquery.js' => false, //disable default implementation of jquery
                'jquery.min.js' => false, //disable any others default implementation
                'core.css' => false, //disable
                'styles.css' => false, //disable
                'pager.css' => false, //disable
                'default.css' => false, //disable
            )
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'siteBase' => '',
        'uploads' => '/var/www/yii/kowop/uploads',
        'temp' => '/var/www/yii/kowop/temp',
        'balancedMarketPlaceURI' => '/v1/marketplaces/TEST-MPShQ51qyQNTEoxoNRJA9zW',
        'balancedAPISecret' => '1cb3181a76ee11e28739026ba7f8ec28',
        'AmazonSESKey'    => 'AKIAI7UQ3ZYLL5SGGILA',
        'AmazonSESSecret' => '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',
        'AmazonSESRegion' => 'us-east-1',
        'PaymentDelay' => '3',
        'HostPercentage' => 0.9,
    ),
);
