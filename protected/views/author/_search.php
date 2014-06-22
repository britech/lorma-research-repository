<?php
/* @var $this AuthorController */
/* @var $model Author */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'key_author'); ?>
		<?php echo $form->textField($model,'key_author'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_lname'); ?>
		<?php echo $form->textField($model,'fld_lname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_fname'); ?>
		<?php echo $form->textField($model,'fld_fname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_mname'); ?>
		<?php echo $form->textField($model,'fld_mname',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'key_dept'); ?>
		<?php echo $form->textField($model,'key_dept'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'key_pub'); ?>
		<?php echo $form->textField($model,'key_pub'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fld_designation'); ?>
		<?php echo $form->textArea($model,'fld_designation',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->