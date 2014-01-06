<?php
/* @var $this PartsItemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Запчасти',
);

$this->menu=array(
	array('label'=>'Create PartsItem', 'url'=>array('create')),
	array('label'=>'Manage PartsItem', 'url'=>array('admin')),
);
?>

<h1><?php if(!empty($this->pageName)){ echo $this->pageName; } else{ echo 'Запчасти'; } ?></h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'ajaxUpdate'=>false,
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'category.category_caption',
		array(
			'name'=>'item_caption',
			'value'=>'CHtml::link(CHtml::encode($data->item_caption), array("view", "id"=>$data->item_id))',
			'type'=>'raw',
		),
		'item_year',
		'item_code',
		array(
			'name'=>'item_price',
			'value'=>(""!==$data->item_price)?$data->item_price:"",
		),
	),
));
?>
