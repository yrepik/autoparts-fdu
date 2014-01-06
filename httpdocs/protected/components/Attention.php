<?php

Yii::import('zii.widgets.CPortlet');

class Attention extends CPortlet
{
	public $title='Внимание!!!';
	public $decorationCssClass = 'portlet-decoration red';
	public $titleCssClass = 'portlet-title red';

	protected function renderContent()
	{
		echo CHtml::tag('span', array(
			'class'=>'tag',
			'style'=>"font-size: 11pt",
		), 'Уважаемые посетители, в связи с постоянно меняющейся ценовой политикой, как в одну, так и в другую сторону просьба уточнять цены на детали у наших менеджеров.');
	}
}