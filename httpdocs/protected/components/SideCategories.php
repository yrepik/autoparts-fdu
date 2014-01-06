<?php

Yii::import('zii.widgets.CPortlet');

class SideCategories extends CPortlet
{
	public $title='Категории запчастей';
	
	public function renderContent()
	{
		$categories = PartsCategory::model()->getCategories();
		
		foreach($categories as $category){
			/*$link=CHtml::link($category->category_id, array('partsItem/index','tag'=>$category));
			echo CHtml::tag('p', array(
					'class'=>'side-category'
				), $link)."\n";*/
			//echo $category->category_caption;
			$get = Yii::app()->getRequest()->getQuery('category_parent');
			if(!$category->category_parent || isset($get)){
				if(!$category->has_child){
					echo CHtml::link('<span class="side-category-img" style="background: url('.Yii::app()->request->baseUrl.'/img/thumbs/thumb_'.$category->category_image.') no-repeat; background-size: 100%; background-position: center;"></span><span class="side-category-caption">'.CHtml::encode($category->category_caption).'</span>',
						array(
							'partsItem/index',
							'item_category_id'=>$category->category_id
						),
						array(
							'class'=>'side-category',
							'title'=>$category->category_caption
						)
					);
				} else {
					echo CHtml::link('<span class="side-category-img" style="background: url('.Yii::app()->request->baseUrl.'/img/thumbs/thumb_'.$category->category_image.') no-repeat; background-size: 100%; background-position: center;"></span><span class="side-category-caption">'.CHtml::encode($category->category_caption).'</span>',
						array(
							'partsCategory/subcategory',
							'category_parent'=>$category->category_id
						),
						array(
							'class'=>'side-category',
							'title'=>$category->category_caption
						)
					);
				}
			}
		}
	}
}