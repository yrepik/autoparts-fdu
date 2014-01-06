<?php
/* @var $this PartsCategoryController */
/* @var $model PartsCategory */

$this->breadcrumbs=array(
	'Категории запчастей'=>array('index'),
	$model->category_id,
);

$this->menu=array(
	array('label'=>'List PartsCategory', 'url'=>array('index')),
	array('label'=>'Create PartsCategory', 'url'=>array('create')),
	array('label'=>'Update PartsCategory', 'url'=>array('update', 'id'=>$model->category_id)),
	array('label'=>'Delete PartsCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->category_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PartsCategory', 'url'=>array('admin')),
);
?>

<h1>Категория &laquo;<?php echo $model->category_caption; ?>&raquo;</h1>

<?php
echo $image = Yii::app()->request->baseUrl.'/../img/'.$model->category_image;
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'category_id',
		'category_parent',
		'category_caption',
		array(
			'name'=>'category_image',
			'type'=>'html',
			'value'=>(!empty($image))?CHtml::image($image, $model->category_caption, array("style"=>"width: 190px;")):"Нет изображения",
		),
	),
)); ?>
