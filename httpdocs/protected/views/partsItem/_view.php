<?php
/* @var $this PartsItemController */
/* @var $data PartsItem */
?>

<div class="view-item">

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->item_id), array('view', 'id'=>$data->item_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_caption')); ?>:</b>
	<?php echo CHtml::encode($data->item_caption); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_year')); ?>:</b>
	<?php echo CHtml::encode($data->item_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_code')); ?>:</b>
	<?php echo CHtml::encode($data->item_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_price')); ?>:</b>
	<?php echo CHtml::encode($data->item_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->item_quantity); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('item_image')); ?>:</b>
	<?php echo CHtml::encode($data->item_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_updated')); ?>:</b>
	<?php echo CHtml::encode($data->item_updated); ?>
	<br />

	*/ ?>

</div>