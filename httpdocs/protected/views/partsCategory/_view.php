<?php
/* @var $this PartsCategoryController */
/* @var $data PartsCategory */
?>

<?php
	$get = Yii::app()->getRequest()->getQuery('category_parent');
	if(!$data->category_parent || isset($get)){

		if(!$data->has_child){
			echo CHtml::link('<span>'.CHtml::encode($data->category_caption).'</span>',
				array(
					'partsItem/index',
					'item_category_id'=>$data->category_id
				),
				array(
					'class'=>'view-category',
					'title'=>$data->category_caption,
					'style'=>'background: url('.Yii::app()->request->baseUrl.'/img/thumbs/thumb_'.$data->category_image.') no-repeat; background-size: 100%; background-position: center;'
				)
			);
		} else {
			echo CHtml::link('<span>'.CHtml::encode($data->category_caption).'</span>',
				array(
					'partsCategory/subcategory',
					'category_parent'=>$data->category_id
				),
				array(
					'class'=>'view-category',
					'title'=>$data->category_caption,
					'style'=>'background: url('.Yii::app()->request->baseUrl.'/img/thumbs/thumb_'.$data->category_image.') no-repeat; background-size: 100%; background-position: center;'
				)
			);
		}
?>

<?php } ?>