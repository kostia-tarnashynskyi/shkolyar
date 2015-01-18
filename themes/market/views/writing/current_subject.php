<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>CHtml::link('Головна', Yii::app()->homeUrl),
    'inactiveLinkTemplate'=>'<noindex><span class="sim-link">{label} <span class="glyphicon glyphicon-chevron-down small"></span></span></noindex>',
));
?>


<h1>Твори <?php echo $this->subjectModel->title; ?></h1>

<?php echo $description; ?>

<div class="separator"></div>
<div class="info">Виберіть клас</div>

<?php $this->widget('ClasNumbWritingCurrentSubjectWidget', array('subject'=>$this->subjectModel)); ?>
<div class="clear"></div>
<div class="separator"></div>

<div class="info">Виберіть твір</div>
<?php $this->widget('DataWritingWidget', array('model'=>$model)); ?>