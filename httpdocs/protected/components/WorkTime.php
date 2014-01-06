<?php

Yii::import('zii.widgets.CPortlet');

class WorkTime extends CPortlet
{
	public $title='Время работы';

	protected function renderContent()
	{
		echo CHtml::tag('span', array(
			'class'=>'tag',
			'style'=>"font-size: 13pt",
		), 'Пн-Пт: 9<sup>00</sup>-17<sup>00</sup><br/>Сб: 9<sup>00</sup>-13<sup>00</sup>');
	}
}