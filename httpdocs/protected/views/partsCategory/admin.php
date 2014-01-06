<?php
/* @var $this PartsCategoryController */
/* @var $model PartsCategory */

$this->breadcrumbs=array(
	'Категории запчастей'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'List PartsCategory', 'url'=>array('index')),
	array('label'=>'Create PartsCategory', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#parts-category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление категориями</h1>

<p>Вы можете вводить операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> или <b>=</b>) в начале каждого искомого значения.</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'parts-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'category_id',
		'category_caption',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
