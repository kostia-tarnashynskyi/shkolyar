<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1><?php echo $this->h1; ?></h1>

<div class="description">
  <?php  echo $description; ?>
</div>
<?php $this->widget('LikeWidget'); ?>
<div class="clear"></div>
<div class="separator"></div>

<div class="full-banner">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- sh полный баннер -->
	<ins class="adsbygoogle"
	     style="display:inline-block;width:728px;height:90px"
	     data-ad-client="ca-pub-9657826060070920"
	     data-ad-slot="7589407895"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>


<div class="info">Виберіть предмет</div>
<?php $this->widget('SubjectWritingWidget', array('model'=>Subject::model()->findAll())); ?>
<div class="clear"></div>
<div class="separator"></div>

<?php $this->widget('DataWritingWidget', array('model'=>$model)); ?>
<div class="clear"></div>
<div class="separator"></div>