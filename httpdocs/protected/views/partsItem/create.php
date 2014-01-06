<?php
/* @var $this PartsItemController */
/* @var $model PartsItem */

$this->breadcrumbs=array(
	'Запчасти'=>array('index'),
	'Добавление',
);

$this->menu=array(
	array('label'=>'List PartsItem', 'url'=>array('index')),
	array('label'=>'Manage PartsItem', 'url'=>array('admin')),
);
?>

<h1>Create PartsItem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'dropdown'=>$dropdown,)); ?>