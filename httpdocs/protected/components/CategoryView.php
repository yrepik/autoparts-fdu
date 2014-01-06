<?php

Yii::import('zii.widgets.CListView');

class CategoryView extends CListView
{
	/**
	 * Renders the data item list.
	 */
	public function renderItems()
	{
		echo CHtml::openTag($this->itemsTagName,array('class'=>$this->itemsCssClass))."\n";
		$data=$this->dataProvider->getData();
		if(($n=count($data))>0)
		{
			$owner=$this->getOwner();
			$viewFile=$owner->getViewFile($this->itemView);
			$j=0;
			$parents = array();

			// Create array with categories id's which have child categories
			foreach($data as $item){
				$category_parent = $item->getAttribute('category_parent');
				if($category_parent!=='0'){
					if(!in_array($category_parent, $parents)){
						array_push($parents, $category_parent);
					}
				}
			}

			foreach($data as $i=>$item){
				// Set has_child attribute for every records with parent category
				if(in_array($item->getAttribute('category_id'), $parents)){
					$item->setAttribute('has_child', '1');
				}

				$datas=$this->viewData;
				$datas['index']=$i;
				$datas['data']=$item;
				$datas['widget']=$this;
				$owner->renderFile($viewFile,$datas);
				if($j++ < $n-1)
					echo $this->separator;
			}
		}
		else
			$this->renderEmptyText();
		echo CHtml::closeTag($this->itemsTagName);
	}
}