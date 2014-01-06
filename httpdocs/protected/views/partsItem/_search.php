<?php
/* @var $this PartsItemController */
/* @var $model PartsItem */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'item_id'); ?>
		<?php echo $form->textField($model,'item_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_category_id'); ?>
		<?php echo $form->textField($model,'item_category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_caption'); ?>
		<?php echo $form->textField($model,'item_caption',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_year'); ?>
		<?php echo $form->textField($model,'item_year',array('size'=>9,'maxlength'=>9)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_code'); ?>
		<?php echo $form->textField($model,'item_code',array('size'=>60,'maxlength'=>127)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_price'); ?>
		<?php echo $form->textField($model,'item_price',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_quantity'); ?>
		<?php echo $form->textField($model,'item_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_image'); ?>
		<?php echo $form->textField($model,'item_image',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'item_updated'); ?>
		<?php echo $form->textField($model,'item_updated'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->