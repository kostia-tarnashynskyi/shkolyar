<?php  
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
?>

<!-- <div class="info">Всезнайка</div> -->
<h3 class="info">Всезнайка</h3>
<?php $this->widget('LastKnowallWidget'); ?>
<div class="separator"></div>

<h3 class="info">Підручники</h3>
<?php $this->widget('LastBookWidget', array('mode'=>'textbook')); ?>
<div class="separator"></div>

<h3 class="info">ГДЗ</h3>
<?php $this->widget('LastBookWidget', array('mode'=>'gdz')); ?>
<div class="separator"></div>

<h3 class="info">Твори</h3>
<?php $this->widget('LastWritingWidget'); ?>
<div class="separator"></div>

<h3 class="info">Художня література</h3>
<?php $this->widget('LastLibraryWidget'); ?>
<div class="separator"></div>

<h1>Шкільний інформаційний портал <div class="logo-title">SHKOLYAR.INFO</div></h1>


<div class="description">
	<?php $this->widget('DescriptionWidget', array('params'=>array('owner'=>'site', 'action'=>'index'))); ?>
</div>