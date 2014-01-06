<?php

class PartsItemController extends Controller
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
				'actions'=>array('index','view'),
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
		$criteria=new CDbCriteria();
		$criteria->select = '*';
		$criteria->addCondition('item_id=:id');
		$criteria->params = array(':id' => $id);
		$data = PartsItem::model()->findAll($criteria);
		
		if($data){
			$this->pageName = trim($data[0]->getAttribute("item_caption")).'. Код запчасти '.trim($data[0]->getAttribute("item_code")).'('.$data[0]->getAttribute("item_id").')';
			$this->pageDescription = trim($data[0]->getAttribute("item_caption")).' для Fiat Doblo '.trim($data[0]->getAttribute("item_year"));
		}

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
		$model=new PartsItem;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PartsItem']))
		{
			$rnd = rand(0,9999);
			$model->attributes=$_POST['PartsItem'];
			
			if( $uploadedFile = CUploadedFile::getInstance($model,'item_image') ){
				$hasImage = true;
				$fileName = "{$rnd}-{$uploadedFile}";
				$model->item_image = $fileName;
			}

			if($model->save())
			{
				$imgDir = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR;
				if( $hasImage ){
					$uploadedFile->saveAs($imgDir.$fileName);
					$image = Yii::app()->image->load($imgDir.$fileName);
					$image->resize(190,190,Image::WIDTH);
					$image->save($imgDir.'thumbs'.DIRECTORY_SEPARATOR.'thumb_'.$fileName);
				}
				$this->redirect(isset($_POST['PartsItem']['returnUrl']) ? $_POST['PartsItem']['returnUrl'] : array('admin'));
			}
		}

		$criteria=new CDbCriteria();
		$criteria->select = 'category_id, category_caption';
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

		if(isset($_POST['PartsItem']))
		{
			$rnd = rand(0,9999);
			$model->attributes=$_POST['PartsItem'];
			
			if( $uploadedFile = CUploadedFile::getInstance($model,'item_image') ){
				$hasImage = true;
				$fileName = "{$rnd}-{$uploadedFile}";
				$model->item_image = $fileName;
			}
				
			if($model->save())
			{
				$imgDir = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR;
				if( $hasImage ){
					$uploadedFile->saveAs($imgDir.$fileName);
					$image = Yii::app()->image->load($imgDir.$fileName);
					$image->resize(190,190,Image::WIDTH);
					$image->save($imgDir.'thumbs'.DIRECTORY_SEPARATOR.'thumb_'.$fileName);
				}
				$this->redirect(isset($_POST['PartsItem']['returnUrl']) ? $_POST['PartsItem']['returnUrl'] : array('admin'));
			}
		}

		$criteria=new CDbCriteria();
		$criteria->select = 'category_id, category_caption';
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
	 * Lists all models.
	 */
	public function actionIndex($item_category_id=0,$search='')
	{
		$model=new PartsCategory('search');
		$this->pageName = 'Запчасти';
		$this->pageDescription = 'Запчасти для Fiat Doblo.';
		if( !empty($search) ){
			$this->pageName = 'Поиск запчастей «'.$search.'»';
			$this->pageDescription = 'Быстрый поиск запчастей для Fiat Doblo.';
			$dataProvider=new CActiveDataProvider('PartsItem', array(
				'criteria'=>array(
					'condition' => "item_caption LIKE :search OR item_id LIKE :search OR item_code LIKE :search",
					'params' => array(
						':search' => "%$search%",
					)
				),
			));
		} else{
			if($item_category_id!==0){
				$dataProvider=new CActiveDataProvider('PartsItem', array(
					'criteria'=>array(
						'condition'=>'item_category_id=:item_category_id',
						'params'=>array(
							':item_category_id' => $item_category_id,
						),
					),
					'pagination'=>array(
						'pageSize'=>Yii::app()->params['itemsPerPage'],
					),
				));

				$partsCategory = new PartsCategory;
				$criteria=new CDbCriteria();
				$criteria->select = 'category_id, category_caption';
				$criteria->addCondition('category_id=:item_category_id');
				$criteria->params = array(':item_category_id' => $item_category_id);
				$data = $partsCategory->findAll($criteria);
				$this->pageName = 'Запчасти Фиат Добло — '.array_pop(CHtml::listData($data, 'category_id', 'category_caption'));
				$this->pageDescription = 'Запчасти для Fiat Doblo из категории «'.array_pop(CHtml::listData($data, 'category_id', 'category_caption')).'».';

			} else{
				$this->pageName = 'Все запчасти Fiat Doblo';
				$this->pageDescription = 'Все наименования запчастей для Fiat Doblo. Поиск.';
				$dataProvider=new CActiveDataProvider('PartsItem');
				}
			}

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PartsItem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PartsItem']))
			$model->attributes=$_GET['PartsItem'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PartsItem the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PartsItem::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PartsItem $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='parts-item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
