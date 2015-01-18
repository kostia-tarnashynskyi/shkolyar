<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// Yii::setPathOfAlias('booster', dirname(__FILE__).DIRECTORY_SEPARATOR.'../vendor/clevertech/yii-booster/src');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SHKOLYAR.INFO',
	'sourceLanguage'=>'en',
	'language'=>'ru',
	'theme'=>'market',
	// 'defaultController'=>'gdz',

	// preloading 'log' component
	'preload'=>array(
		'log', 
		// 'bootstrap'
	),

	//GZIP compress   
	// 'onBeginRequest'=>create_function('$event', 'return ob_start("ob_gzhandler");'),
	// 'onEndRequest'=>create_function('$event', 'return ob_end_flush();'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.extensions.*',
		'application.components.*',
		// 'application.components.widgets.*',
		// 'application.components.widgets.subjectWidget.*',
		// 'application.components.widgets.clasNumbWidget.*',
		// 'application.components.widgets.bookWidget.*',
		// 'application.components.widgets.oneBookWidget.*',
		// 'application.components.widgets.taskWidget.*',
		'application.components.widgets.taskTitleWidget.*',
		// 'application.components.widgets.tabWidget.*',
		// 'application.components.widgets.tizerWidget.*',
		'application.components.widgets.relativeBooksWidget.*',

		'application.helpers.*',
		'application.widgets.clasNumbWidget.*',
		'application.widgets.clasNumbCurrentSubjectWidget.*',
		'application.widgets.clasNumbWritingCurrentSubjectWidget.*',
		'application.widgets.subjectWidget.*',
		'application.widgets.subjectWritingWidget.*',
		'application.widgets.bookWidget.*',
		'application.widgets.dataBookWidget.*',
		'application.widgets.oneBookWidget.*',
		'application.widgets.libraryBookWidget.*',
		'application.widgets.taskWidget.*',
		'application.widgets.linkPagerWidget.*',
		'application.widgets.breadcrumdsWidget.*',
		'application.widgets.relativeGdzWidget.*',
		'application.widgets.bookSidebarMenuWidget.*',
		'application.widgets.writingSidebarMenuWidget.*',
		'application.widgets.librarySidebarMenuWidget.*',
		'application.widgets.knowallSidebarMenuWidget.*',
		'application.widgets.sidebarMenuWidget.*',
		'application.widgets.nestedWidget.*',
		'application.widgets.lastBookWidget.*',
		'application.widgets.lastKnowallWidget.*',
		'application.widgets.dataArticleWidget.*',
		'application.widgets.dataWritingWidget.*',
		'application.widgets.dataLibraryWidget.*',
		'application.widgets.libraryAuthorWidget.*',
		'application.widgets.writingClasWidget.*',
		'application.widgets.descriptionWidget.*',
		'application.widgets.knowallCategoryWidget.*',

		'ext.ExtendedClientScript.jsmin.*',
		'ext.ExtendedClientScript.cssmin.*'
	),

	'modules'=>array(

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'inside',
		'ajax'
		
	),

	// application components
	'components'=>array(

       'authManager' => array(
		    // Будем использовать свой менеджер авторизации
		    'class' => 'PhpAuthManager',
		    // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
		    'defaultRoles' => array('guest'),
		),

       'user'=>array(
		    'class' => 'WebUser',
		    'loginUrl'=>array('site/login'),
		    'allowAutoLogin' 	=> true,
		),

       'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
           // 'params'=>array('directory'=>'D:/Program Files/ImageMagick-6.4.8-Q16'),
        ),

		'request'=>array(
            'enableCsrfValidation'=>false,
            'enableCookieValidation'=>false,
        ),

		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(

				'/inside/<controller:\w+>/<action:\w+>/<id:\d+>'=>'inside/<controller>/<action>',
				'/inside/<controller:\w+>/<action:\w+>'=>'inside/<controller>/<action>',
				'/inside/<controller:\w+>'=>'inside/<controller>/index',

				'/ajax/<controller:\w+>/<action:\w+>'=>'ajax/<controller>/<action>',

				'<action:about|advertiser|rules|rightholder|contacts>'=>'site/page',
				'/jewel' => 'site/jewel',
				'/site/login' => 'site/login',
				'/site/logout' => 'site/logout',
				'writing/<clas:\d+>/<category:[a-z-]+>/<article:[a-z-]+>'=>'writing/view',
				
				'<controller:\w+>/<clas:\d+>/<subject:[a-z-]+>/<book:[a-z-]+>/<section:\d+>/<paragraph:\d+>/<task:\d+>'=>'<controller>/nestedTwo',
				'<controller:\w+>/<clas:\d+>/<subject:[a-z-]+>/<book:[a-z-]+>/<section:\d+>/<task:\d+>'=>'<controller>/nestedOne',
				'<controller:\w+>/<clas:\d+>/<subject:[a-z-]+>/<book:[a-z-]+>/<task:\d+>'=>'<controller>/task',
				'<controller:\w+>/<clas:\d+>/<subject:[a-z-]+>/<book:[a-z-]+>'=>'<controller>/book',
				'<controller:\w+>/<clas:\d+>/<subject:[a-z-]+>'=>'<controller>/subject',
				'<controller:\w+>/<clas:\d+>'=>'<controller>/clas',

				'<controller:gdz|textbook|writing>/<subject:[a-z-]+>'=>'<controller>/currentSubject',

				'<controller:\w+>/<category:\w+>/<article:[a-z-]+>'=>'<controller>/view',
				
				'<controller:knowall|library|writing>/<category:\w+>/<page:\d+>'=>'<controller>/category',
				'<controller:knowall|library|writing>/<category:\w+>'=>'<controller>/category',
				
				'<controller:knowall|library|writing>/<page:\d>'=>'<controller>/index',
				'<controller:\w+>'=> '<controller>/index',

				// 'tizer'=>'tizer/index',
				// 'position'=>'position/index',
				'sitemap.xml'=>'sitemap/index',
				
				
				
				

				// '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				// '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				// '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		'db'=> require(dirname(__FILE__).'/_db.php'),
		
		'errorHandler'=>array(
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
				
				// array(
				// 	'class'=>'CWebLogRoute',
				// ),
				
			),
		),

		'cache'=>array(
            'class'=>'system.caching.CDummyCache',
            // 'class'=>'system.caching.CFileCache',
        ),

        'clientScript'=>array(
            'class'=>'ext.ExtendedClientScript.ExtendedClientScript',
            'combineCss'=>false,
            'compressCss'=>false,
            'combineJs'=>false,
            'compressJs'=>false,
			'scriptMap'=>array(
				'jquery.js'=>'/js/jquery1.11.1.min.js',
				// 'jquery.cookie.js'=>'/js/jquery1.11.1.min.js',
				'jquery.min.js'=>'http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js',
			)
        ),

  //       'clienScript'=>array(
		// );

        'file' => array(
            'class'=>'application.extensions.file.CFile',
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'audiua@yandex.ru',
	),
);