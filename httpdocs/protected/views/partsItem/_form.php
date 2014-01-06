<?php
/* @var $this PartsItemController */
/* @var $model PartsItem */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parts-item-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	),
)); ?>
	<?php echo $form->hiddenField($model,'returnUrl', array( 'value' => Yii::app()->request->urlReferrer)) ?>
	<p class="note">Поля, отмеченные <span class="required">*</span> — обязательные.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'item_category_id'); ?>
		<?php echo $form->dropDownList($model, 'item_category_id', $dropdown, array('empty'=>'') ); ?>
		<?php echo $form->error($model,'item_category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_caption'); ?>
		<?php echo $form->textField($model,'item_caption',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'item_caption'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_year'); ?>
		<?php echo $form->textField($model,'item_year',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'item_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_code'); ?>
		<?php echo $form->textField($model,'item_code',array('size'=>60,'maxlength'=>127)); ?>
		<?php echo $form->error($model,'item_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_price'); ?>
		<?php echo $form->textField($model,'item_price',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'item_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_quantity'); ?>
		<?php echo $form->textField($model,'item_quantity'); ?>
		<?php echo $form->error($model,'item_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_image'); ?>
		<?php echo $form->fileField($model,'item_image'); ?>
		<?php echo $form->error($model,'item_image'); ?>
	</div>

	<?php
	// Image shown here if page is update page
	if($model->isNewRecord!='1'){?>
	<div class="row">
		<?php echo CHtml::image(Yii::app()->request->baseUrl.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'thumbs'.DIRECTORY_SEPARATOR.'thumb_'.$model->item_image,"image",array("width"=>200)); ?>
	</div>
	<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->