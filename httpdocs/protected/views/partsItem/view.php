<?php
/* @var $this PartsItemController */
/* @var $model PartsItem */
$this->breadcrumbs=array(
	'Запчасти «'.$model->category->category_caption.'»'=>(Yii::app()->request->urlReferrer)?Yii::app()->request->urlReferrer:(array('index', 'item_category_id'=>$model->item_category_id)),
	$model->item_caption,
);

$this->menu=array(
	array('label'=>'List PartsItem', 'url'=>array('index')),
	array('label'=>'Create PartsItem', 'url'=>array('create')),
	array('label'=>'Update PartsItem', 'url'=>array('update', 'id'=>$model->item_id)),
	array('label'=>'Delete PartsItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->item_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PartsItem', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->item_caption; ?></h1>

<?php
$image = Yii::app()->request->baseUrl.'/../img/'.$model->item_image;
//echo CHtml::image($image, $data->item_caption, array("style"=>"width: 190px;"));
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'item_id',
		'category.category_caption',
		'item_caption',
		'item_year',
		'item_code',
		array(
			'name'=>'item_price',
			'value'=>($model->item_price)?$model->item_price:"Уточните у менеджера",
		),
		array(
			'name'=>'item_quantity',
			'value'=>(!empty($model->item_quantity))?$model->item_quantity:"В наличии",
		),
		array(
			'name'=>'item_image',
			'type'=>'html',
			'value'=>(!empty($model->item_image))?CHtml::image($image, $data->item_caption, array("style"=>"width: 190px;")):"Нет изображения",
		),
		array(
			'name'=>'item_updated',
			'value'=>$model->item_updated,
			'visible'=>!Yii::app()->user->isGuest,
		),
	),
));
?>
