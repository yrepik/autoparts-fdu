<?php
/* @var $this PartsItemController */
/* @var $model PartsItem */

$this->breadcrumbs=array(
	'Запчасти'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'List PartsItem', 'url'=>array('index')),
	array('label'=>'Create PartsItem', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#parts-item-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление товарами</h1>

<p>Вы можете вводить операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> или <b>=</b>) в начале каждого искомого значения.</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'parts-item-grid',
	'ajaxUpdate'=>false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'item_id',
		'category.category_caption',
		'item_caption',
		'item_year',
		'item_code',
		'item_price',
		/*
		'item_quantity',
		'item_image',
		'item_updated',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
