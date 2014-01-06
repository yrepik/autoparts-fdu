<ul>
	<!--<li><?php /*echo CHtml::link('Новая статья',array('post/create')); */?></li>
	<li><?php /*echo CHtml::link('Управление статьями',array('post/admin')); */?></li>
	<li><?php /*echo CHtml::link('Комментарии',array('comment/index')) . ' (' . Comment::model()->pendingCommentCount . ')'; */?></li>-->
	<li><?php echo CHtml::link('Новый товар',array('partsItem/create')); ?></li>
	<li><?php echo CHtml::link('Новая категория',array('partsCategory/create')); ?></li>
	<li><?php echo CHtml::link('Товары',array('partsItem/admin')); ?></li>
	<li><?php echo CHtml::link('Категории',array('partsCategory/admin')); ?></li>
</ul>