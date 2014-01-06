<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
	<title><?php if(!empty($this->pageName)){ echo CHtml::encode($this->pageName); } ?></title>
	<meta name="description" content="<?php if(!empty($this->pageDescription)){ echo CHtml::encode($this->pageDescription); } ?>" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon">
	<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-37827540-1']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

	</script>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo">
			<a class="logo-link" href="<?php echo Yii::app()->homeUrl;?>" rel="nofollow"><span>Главная</span></a>
			<p class="site-name"><?php echo CHtml::encode(Yii::app()->name); ?></p>
			<!--<p class="site-slogan">
				Самые низкие цены и только оригинальные запчасти Fiat Doblo.<br/>
				Всегда рады вам помочь!
			</p>-->
			<p class="site-slogan">
				Также принимаем заказы на запчасти для автомобилей<br>
				моделей: Ducato, Fiorino-Qubo, Scudo, Albea, Linea.
			</p>
		</div>
		<div class="top-search-form">
			<form action="<?php echo Yii::app()->baseUrl.'/search';?>" method="get">
				<input type="text" name="search" size="30" .>
				<input type="submit" value="Поиск запчастей" />
			</form>
		</div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php
		$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
                array('label'=>'О нас', 'url'=>array('site/page', 'view'=>'about')),
				array('label'=>'Оплата и доставка', 'url'=>array('site/page', 'view'=>'delivery')),
				array('label'=>'Напишите нам', 'url'=>array('site/contact')),
				array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('user/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		));
		/*array('label'=>'Вход', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),*/
		?>
	</div><!-- mainmenu -->

	<?php
	$this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
        'homeLink'=>CHtml::link('Главная', Yii::app()->homeUrl),
    ));
	?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div id="footer">
		<?php echo Yii::app()->params['copyrightInfo']; ?>
	</div><!-- footer -->

</div><!-- page -->
<script type="text/javascript"> _shcp = []; _shcp.push({widget_id : 612574, widget : "Chat"}); (function() { var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true; hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://widget.siteheart.com/apps/js/sh.js"; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(hcc, s.nextSibling); })();</script>
</body>
</html>