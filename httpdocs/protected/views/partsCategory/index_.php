<?php
/* @var $this PartsCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Категории',
);

$this->menu=array(
	array('label'=>'Create PartsCategory', 'url'=>array('create')),
	array('label'=>'Manage PartsCategory', 'url'=>array('admin')),
);
?>

<h1>Категории запчастей Fiat Doblo</h1>

<?php
$this->widget('CategoryView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
?>

<?php
$controller = Yii::app()->getController();
$default_controller = Yii::app()->defaultController;
$isHome = (($controller->id === $default_controller) && ($controller->action->id === $controller->defaultAction)) ? true : false;

if($isHome){
?>
<p class="clear">
	Фиат Добло Дилер поможет подобрать и купить <strong>запчасти Фиат Добло</strong> (Fiat Doblo).
	Вы сможете найти любые автомобильные детали для любого поколения Фиат Добло - от 2000 до 2013 года.
</p>
<p>
	Фиат Добло Дилер осуществляет продажу оригинальных запчастей итальянского и турецкого производства по самым низким ценам.
</p>
<p>
	Для того, чтобы <strong>купить запчасти</strong> на нашем сайте, воспользуйтесь быстрым поиском деталей по названию или коду,
	либо перейдите в подходящую категорию автозапчастей: «Кузов и оптика», «Двигатель», «Охлаждение», «Зажигание»,
	«Тормозная система», «Сцепление», «Масла и смазки», «Система управления», «Выхлопная система», «Тюнинг»,
	«Коробка передач».
</p>
<p>
	В категории «Двигатель» представлены различные подкатегории запчастей для <strong>Фиат Добло</strong> — двигатели 1.2, 1.3MJTD,
	1.4, 1.6, 1.6MJTD, 1.9D, 1.9JTD, 1.9MJTD, 2.0MJTD.
</p>
<p>
	На вопросы относительно процесса покупки автодеталей с радостью ответят наши менеджеры.
</p>
<p>
	Наши клиенты ценят в работе <strong>Фиат Добло Дилер</strong> прежде всего:
	<ul>
		<li>Низкие цены и наивысшее качество</li>
		<li>Удобный и быстрый поиск</li>
		<li>Огромный выбор автозапчастей <strong>Fiat Doblo</strong></li>
		<li>Профессиональную консультацию при заказе товара</li>
		<li>Быструю доставку в любой город на карте Украины</li>
	</ul>
</p>
<?php } ?>