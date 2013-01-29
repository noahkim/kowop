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
            'baseUrl' => 'http://' . $_SERVER['SERVER_NAME'] . '/yii/kowopdev/hybridauth',
            'withYiiUser' => false, // Set to true if using yii-user
            "providers" => array(
                /*"Google" => array(
                    "enabled" => true,
                    "keys" => array("id" => "346522202623.apps.googleusercontent.com", "secret" => "n1mpAUFpf4oOos1dFqsfEuJc"),
                    "scope" => ""
                ),*/
                "Facebook" => array(
                    "enabled" => true,
                    "keys" => array("id" => "126428637531867", "secret" => "732e1160e96faa0cd5bf4c6e43607dd1"),
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
        // uncomment the following to enable URLs in path-format

        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
            'showScriptName' => false
        ),

        /*
        'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ),
        */
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=rebuttme_kowopdev',
            'emulatePrepare' => true,
            'username' => 'rebuttme_kowop',
            'password' => 'kowop123',
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
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'siteBase' => '/yii/kowopdev',
        'uploads' => '/home4/rebuttme/public_html/yii/kowopdev/uploads',
        'temp' => '/home4/rebuttme/public_html/yii/kowopdev/temp'
    ),
);
