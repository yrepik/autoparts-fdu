<?php

Yii::import('zii.widgets.CPortlet');

class Contacts extends CPortlet
{
	public $title='Наши контакты';

	protected function renderContent()
	{
		echo CHtml::tag('span', array(
			'class'=>'tag',
			'style'=>"font-size: 13pt",
		), 'г. Житомир<br/>ул. Коммерческая 8 офис 1<br/><br/>');
		echo CHtml::tag('span', array(
			'class'=>'tag',
			'style'=>"font-size: 13pt",
		), '<small>+38</small>(093) 499 66 26<br/><small>+38</small>(050) 8 777 508<br/><small>+38</small>(067) 393 77 89');
	}
}