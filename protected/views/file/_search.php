<?php
/* @var $this FileController */
/* @var $model File */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'key_pub_file'); ?>
		<?php echo $form->textField($model,'key_pub_file',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_file_title'); ?>
		<?php echo $form->textArea($model,'fld_file_title',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'key_folder_group'); ?>
		<?php echo $form->textField($model,'key_folder_group'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_file_position'); ?>
		<?php echo $form->textField($model,'fld_file_position'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_no_pages'); ?>
		<?php echo $form->textField($model,'fld_no_pages'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'key_pub'); ?>
		<?php echo $form->textField($model,'key_pub'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_dload_restriction'); ?>
		<?php echo $form->textField($model,'fld_dload_restriction',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->