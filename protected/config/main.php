<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'theme' => 'classic',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Astronodes',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),  //bootstrap added

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
	),

	'aliases' => array(
		'xupload' => 'ext.xupload'),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>FALSE,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

		'admin',
	
	),

	// application components

	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'bootstrap' => array(  //adding bootstrap component
			'class' => 'ext.bootstrap.components.Bootstrap',
			'responsiveCss' => true,
			),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=astronodes',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

		'authManager' => array(
			'class' => 'CDbAuthManager',
			'connectionID'=>'db',
			'itemTable' => 'tbl_auth_item',
			'itemChildTable' => 'tbl_auth_item_child',
			'assignmentTable' => 'tbl_auth_assignment',
			),
		'image' => array(
					'class' => 'application.extensions.image.CImageComponent',
					'driver' => 'GD',
					'params' => array('directory' => '/opt/local/bin'),
					),
	
			'mail' => array(
			'class' => 'ext.yii-mail.YiiMail',
			'transportType' => 'smtp',
			'transportOptions' => array(
				'host' => 'smtp.gmail.com',
				'username' => 'astronodez',
				'password' => 'msasgizmo1986',
				'port' => '465',
				'encryption'=> 'ssl',
				),
			'viewPath' => 'application.views.mail',
			'logging' => true,
			'dryRun' => FALSE
			),
		),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'astronodez@gmail.com',
		'commentNeedApproval' => TRUE,
	),
);