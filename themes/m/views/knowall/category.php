<h1>Всезнайка <?php echo $category->title; ?></h1> 

<div class="description">
	<?php $this->widget('DescriptionWidget', array('params'=>array('owner'=>'knowall', 'action'=>'category', 'category_id'=>$category->id))); ?>
</div>

<?php $this->widget('BannerWidget', array('params'=>array('name'=>'big-middle'))); ?>

<?php $this->widget('DataArticleWidget', array('model'=>$model, 'params'=>array('linkCategory'=>false))); ?>
<div class="clear"></div>
<div class="separator"></div>