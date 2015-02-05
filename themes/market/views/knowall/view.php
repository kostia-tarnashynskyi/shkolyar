<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>

<h1><?php echo  $model->title; ?> </h1>

<div class="knowall-article">
	
<?php echo  $model->text; ?>
	
</div>


<div class="clear"></div>
<div class="separator"></div>
<div class="info">Схожі статті</div>
<div class="task-block">
	<?php 
	Yii::import( 'application.widgets.relativeKnowallWidget.RelativeKnowallWidget');
	$this->widget('RelativeKnowallWidget', array('article'=>$model)); ?>
</div>