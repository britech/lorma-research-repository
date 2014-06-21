<?php
/* @var $this PublicationController */
/* @var $model Publication */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'key_pub'); ?>
		<?php echo $form->textField($model,'key_pub'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_pub_title'); ?>
		<?php echo $form->textArea($model,'fld_pub_title',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_txt_page'); ?>
		<?php echo $form->textField($model,'fld_txt_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_no_page'); ?>
		<?php echo $form->textField($model,'fld_no_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_location'); ?>
		<?php echo $form->textArea($model,'fld_location',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'key_dept'); ?>
		<?php echo $form->textField($model,'key_dept'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_date_stored'); ?>
		<?php echo $form->textField($model,'fld_date_stored'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_format_type'); ?>
		<?php echo $form->textField($model,'fld_format_type',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_is_visible'); ?>
		<?php echo $form->textField($model,'fld_is_visible'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->