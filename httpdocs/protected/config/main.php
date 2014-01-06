<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Фиат Добло Дилер',
	'sourceLanguage' => 'en',
	'language' => 'ru',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
	),

	// default controller
	'defaultController'=>'partsCategory',

	// application modules
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
			'ipFilters'=>false,
		),
		'user' => array(
			'debug' => false,
			'userTable' => 'doblo_user',
			'translationTable' => 'doblo_translation',
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class' => 'application.modules.user.components.YumWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		/*'db'=>array(
			'connectionString'=>'sqlite:protected/data/blog.db',
			'tablePrefix'=>'tbl_',
		),*/
		'db'=>array(
			'connectionString'=>'mysql:host=localhost;dbname=fdu_doblo_parts',
			'emulatePrepare'=>true,
			'username'=>'user',
			'password'=>'pass',
			'charset'=>'utf8',
			'tablePrefix'=>'doblo_',
		),
		'dbDobloParts'=>array(
			'connectionString'=>'mysql:host=localhost;dbname=fdu_doblo_parts',
			'emulatePrepare'=>true,
			'username'=>'user',
			'password'=>'pass',
			'charset'=>'utf8',
			'tablePrefix'=>'doblo_',
			'class'=>'CDbConnection',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			"urlSuffix"=>"/",
			'showScriptName'=>false,
			'rules'=>array(
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'cat/sub/<category_parent:\d+>'=>'partsCategory/subcategory',
				'cat/<item_category_id:\d+>'=>'partsItem/index',
				'cat/<item_category_id:\d+>/<PartsItem_page:\d+>'=>'partsItem/index',
				'search'=>'partsItem/index',
				'item/<id:\d+>'=>'partsItem/view',
				'page/<view:\w+>'=>'site/page',
				'sitemap.xml'=>'site/sitemapxml',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				/*array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),*/
				array(
					'class'=>'CWebLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'image'=>array(
			'class'=>'application.extensions.image.CImageComponent',
			'driver'=>'GD',
		),
		'cache' => array(
			'class' => 'system.caching.CDummyCache'
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);