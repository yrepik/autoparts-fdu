<?php
/* @var $this PartsCategoryController */
/* @var $model PartsCategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parts-category-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	),
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span> — обязательные.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_parent'); ?>
		<?php echo $form->dropDownList($model, 'category_parent', $dropdown, array('empty'=>'') ); ?>
		<?php echo $form->error($model,'category_parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_caption'); ?>
		<?php echo $form->textField($model,'category_caption',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'category_caption'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_image'); ?>
		<?php echo CHtml::activeFileField($model,'category_image'); ?>
		<?php echo $form->error($model,'category_image'); ?>
	</div>

	<?php
	// Image shown here if page is update page
	if($model->isNewRecord!='1'){?>
	<div class="row">
		<?php echo CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.'thumb_'.$model->category_image,"image",array("width"=>200)); ?>
	</div>
	<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->