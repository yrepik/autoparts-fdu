<?php

class SiteController extends Controller
{
	public $layout='column1';
	public $pageName;
	public $pageDescription;

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Спасибо за письмо. Мы ответим Вам в самые короткие сроки.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Render the sitemap as human readable text
	 */
	public function actionSitemap()
	{
		$list = array();

		$this->populateSitemap($list);

		$this->render('sitemap',array('list'=>$list));
	}
	/**
	 * Render the sitemap in XML form
	 */
	public function actionSitemapXML()
	{
		$list = array();

		$this->populateSitemap($list);

		header('Content-Type: application/xml');
		$this->renderPartial('sitemapxml',array('list'=>$list));
	}
	/**
	 * Populate the array of site links
	 * @param array[] &$list The array which holds the array of link information: loc, frequency, priority
	 */
	public function populateSitemap( &$list )
	{

		$categories = PartsCategory::model()->findAll();
		$items = PartsItem::model()->findAll();

		// Add primary items here
		$list[] = array(
			'loc'=>$this->createAbsoluteUrl('/'),
			'frequency'=>'monthly',
			'priority'=>'1',
		);
		$list[] = array(
			'loc'=>$this->createAbsoluteUrl('/site/contact'),
			'frequency'=>'monthly',
			'priority'=>'0.8',
		);
		$list[] = array(
			'loc'=>$this->createAbsoluteUrl('/site/page', array('view'=>'about')),
			'frequency'=>'monthly',
			'priority'=>'0.8',
		);

		foreach( $categories as $row )
		{
			$list[] = array(
				'loc'=> $this->createAbsoluteUrl('/partsItem/index',array('item_category_id'=>$row->category_id )),
				'frequency'=>'monthly',
				'priority'=>'0.7',
			);
		}
		foreach( $items as $row )
		{
			$list[] = array(
				'loc'=> $this->createAbsoluteUrl('/partsItem/view',array('id'=>$row->item_id )),
				'frequency'=>'monthly',
				'priority'=>'0.6',
			);
		}
	}
}
