<?php
/* @var $this PartsCategoryController */
/* @var $model PartsCategory */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'category_id'); ?>
		<?php echo $form->textField($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category_parent'); ?>
		<?php echo $form->textField($model,'category_parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category_caption'); ?>
		<?php echo $form->textField($model,'category_caption',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category_image'); ?>
		<?php echo $form->textField($model,'category_image',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category_updated'); ?>
		<?php echo $form->textField($model,'category_updated'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->