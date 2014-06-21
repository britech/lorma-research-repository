<?php
/* @var $this FolderController */
/* @var $model Folder */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'key_folder_group'); ?>
		<?php echo $form->textField($model,'key_folder_group'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_group_name'); ?>
		<?php echo $form->textArea($model,'fld_group_name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_description'); ?>
		<?php echo $form->textArea($model,'fld_description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->