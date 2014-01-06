<?php
/* @var $this PartsCategoryController */
/* @var $model PartsCategory */

$this->breadcrumbs=array(
	'Категории запчастей'=>array('index'),
	$model->category_id=>array('view','id'=>$model->category_id),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'List PartsCategory', 'url'=>array('index')),
	array('label'=>'Create PartsCategory', 'url'=>array('create')),
	array('label'=>'View PartsCategory', 'url'=>array('view', 'id'=>$model->category_id)),
	array('label'=>'Manage PartsCategory', 'url'=>array('admin')),
);
?>

<h1>Редактирование категории &laquo;<?php echo $model->category_caption; ?>&raquo;</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'dropdown'=>$dropdown,)); ?>