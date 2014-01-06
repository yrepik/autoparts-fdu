<?php
/* @var $this PartsCategoryController */
/* @var $model PartsCategory */

$this->breadcrumbs=array(
	'Категории запчастей'=>array('index'),
	'Добавление',
);

$this->menu=array(
	array('label'=>'List PartsCategory', 'url'=>array('index')),
	array('label'=>'Manage PartsCategory', 'url'=>array('admin')),
);
?>

<h1>Добавление категории</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'dropdown'=>$dropdown,)); ?>