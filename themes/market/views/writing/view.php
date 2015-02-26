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

<?php if (! Yii::app()->user->isGuest) {
	echo CHtml::link('Редагувати', array('/inside/'.$this->id.'/update/'.$model->id), array('class'=>'btn btn-success btn-lg', 'target'=>'_blank'));
} ?>
	
</div>

<?php $this->widget('LikeWidget'); ?>

<div class="clear"></div>
<div class="separator"></div>
<div class="info">Схожі твори для <?= $this->param['clas'] ?> класу</div>
<div class="task-block">
	<?php 
	Yii::import( 'application.widgets.relativeWritingWidget.RelativeWritingWidget');
	$this->widget('RelativeWritingWidget', array('article'=>$model)); ?>
</div>
