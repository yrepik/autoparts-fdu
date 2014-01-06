<?php 

$this->beginContent('/layouts/main'); 

$controller = Yii::app()->getController();
$default_controller = Yii::app()->defaultController;
$isHome = (($controller->id === $default_controller) && ($controller->action->id === $controller->defaultAction)) ? true : false;
?>
<div class="container">
	<div class="span-18">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-6 last">
		<div id="sidebar">
			<?php if(!Yii::app()->user->isGuest) $this->widget('UserMenu'); ?>

			<?php /*$this->widget('TagCloud', array(
				'maxTags'=>Yii::app()->params['tagCloudCount'],
			));*/ ?>

			<?php $this->widget('Contacts', array()); ?>
			<?php $this->widget('WorkTime', array()); ?>
			<?php $this->widget('Attention', array()); ?>
			<?php if(!$isHome) $this->widget('SideCategories'); ?>

			<?php /*$this->widget('RecentComments', array(
				'maxComments'=>Yii::app()->params['recentCommentCount'],
			));*/ ?>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>