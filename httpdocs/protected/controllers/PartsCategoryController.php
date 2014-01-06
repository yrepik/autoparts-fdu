<?php

class PartsCategoryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $pageName;
	public $pageDescription;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','subcategory'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('fiat'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('fiat'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PartsCategory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PartsCategory']))
		{
			$rnd = rand(0,9999);  // generate random number between 0-9999
			$model->attributes=$_POST['PartsCategory'];

			$uploadedFile=CUploadedFile::getInstance($model,'category_image');
			$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
			$model->category_image = $fileName;
			
			if($model->save())
			{
				if(!empty($uploadedFile))  // check whether uploaded file is set or not
				{
					$imgDir = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR;
					$uploadedFile->saveAs($imgDir.$fileName);
					$image = Yii::app()->image->load($imgDir.$fileName);
					$image->resize(380,380,Image::HEIGHT);
					$image->save($imgDir.'thumbs'.DIRECTORY_SEPARATOR.'thumb_'.$fileName);
				}
				$this->redirect(array('admin'));
			}
		}

		$criteria=new CDbCriteria();
		$criteria->select = 'category_id, category_caption';
		$criteria->addCondition('category_parent=0');
		$data = PartsCategory::model()->findAll($criteria);
		$dropdown = CHtml::listData($data, 'category_id', 'category_caption');

		$this->render('create',array(
			'model'=>$model,
			'dropdown'=>$dropdown,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PartsCategory']))
		{
			$rnd = rand(0,9999);  // generate random number between 0-9999
			$model->attributes=$_POST['PartsCategory'];

			$uploadedFile=CUploadedFile::getInstance($model,'category_image');
			$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
			$model->category_image = $fileName;

			if($model->save())
			{
				if(!empty($uploadedFile))  // check whether uploaded file is set or not
				{
					$imgDir = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR;
					$uploadedFile->saveAs($imgDir.$fileName);
					$image = Yii::app()->image->load($imgDir.$fileName);
					$image->resize(380,380,Image::HEIGHT);
					$image->save($imgDir.'thumbs'.DIRECTORY_SEPARATOR.'thumb_'.$fileName);
				}
				$this->redirect(array('admin'));
			}
		}

		$criteria=new CDbCriteria();
		$criteria->select = 'category_id, category_caption';
		$criteria->addCondition('category_parent=0');
		$data = PartsCategory::model()->findAll($criteria);
		$dropdown = CHtml::listData($data, 'category_id', 'category_caption');

		$this->render('update',array(
			'model'=>$model,
			'dropdown'=>$dropdown,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Parent categories.
	 */
	public function actionIndex()
	{
		$this->pageName = Yii::app()->name.' — Запчасти Fiat Doblo: каталог, цены';
		$this->pageDescription = 'Фиат Добло Дилер предлагает купить запчасти для Fiat Doblo по самым низким ценам в Украине. Доставка запчастей во все регионы.';
		$model=new PartsCategory('search');

		$dataProvider=new CActiveDataProvider('PartsCategory', array(
			'criteria'=>array(
				'condition'=>'',
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['categoriesPerPage'],
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}

	/**
	 * Subcategories.
	 */
	public function actionSubcategory($category_parent)
	{
		$dataProvider=new CActiveDataProvider('PartsCategory', array(
			'criteria'=>array(
				'condition'=>'category_parent=:category_parent',
				'params'=>array(
					':category_parent' => $category_parent,
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['categoriesPerPage'],
			),
		));

		$criteria=new CDbCriteria();
		$criteria->select = 'category_id, category_caption';
		$criteria->addCondition('category_id=:category_parent');
		$criteria->params = array(':category_parent' => $category_parent);
		$data = PartsCategory::model()->findAll($criteria);
		$this->pageName = 'Запчасти Фиат Добло — '.array_pop(CHtml::listData($data, 'category_id', 'category_caption'));
		$this->pageDescription = 'Запчасти для двигателя Фиат Добло. Fiat Doblo 1.2, Fiat Doblo 1.3MJTD, Fiat Doblo 1.4, Fiat Doblo 1.6, Fiat Doblo 1.9D, Fiat Doblo 1.9JTD-1.9MJTD, Fiat Doblo 2.0MJTD.'.array_pop(CHtml::listData($data, 'category_id', 'category_caption'));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PartsCategory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PartsCategory']))
			$model->attributes=$_GET['PartsCategory'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PartsCategory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PartsCategory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PartsCategory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='parts-category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
