<?php
/* @var $this PartsItemController */
/* @var $model PartsItem */

$this->breadcrumbs=array(
	'Запчасти'=>array('index'),
	$model->item_id=>array('view','id'=>$model->item_id),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'List PartsItem', 'url'=>array('index')),
	array('label'=>'Create PartsItem', 'url'=>array('create')),
	array('label'=>'View PartsItem', 'url'=>array('view', 'id'=>$model->item_id)),
	array('label'=>'Manage PartsItem', 'url'=>array('admin')),
);
?>

<h1>Редактирование товара №<?php echo $model->item_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'dropdown'=>$dropdown,)); ?>