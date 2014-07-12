<?php
/* @var $model Folder */

$this->pageTitle=Yii::app()->name.' - Manage Folder Groups';

if($model->isNewRecord){
	$this->breadcrumbs=array(
			'Publication Directory'=>array('publication/index'),
			'Folder Groups'
	);
	
	$this->menu=array(
			array('label'=>'Upload a Publication', 'url'=>array('publication/create')),
			array('label'=>'Publication Directory', 'url'=>array('publication/index')),
	);
} else{
	$this->breadcrumbs=array(
			'Publication Directory'=>array('publication/index'),
			'Folder Groups'=>array('folder/index'),
			$model->fld_group_name
	);
	
	$this->menu=array(
			array('label'=>'Manage Folder Groups', 'url'=>array('index')),
			array('label'=>'Folder Information', 'url'=>array('view', 'id'=>$model->key_folder_group)),
			array('label'=>'Upload a Publication', 'url'=>array('publication/create')),
			array('label'=>'Publication Directory', 'url'=>array('publication/index')),
	);
}


?>
<h1>Folder Groups</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'folder-form',
	'action'=>$model->isNewRecord ? array('folder/create') : array('folder/update', 'id'=>$model->key_folder_group),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_group_name'); ?>
		<?php echo $form->textField($model,'fld_group_name',array('size'=>50)); ?>
		<?php echo $form->error($model,'fld_group_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fld_order');?>
		<?php echo $form->textField($model,'fld_order',array('size'=>50)); ?>
		<?php echo $form->error($model,'fld_order'); ?>
		<p class="hint">Note: 1 as the highest order</p>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fld_description'); ?>
		<?php echo $form->textArea($model,'fld_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fld_description'); ?>
	</div>

	<div class="row buttons">
		<?php echo $model->isNewRecord ? CHtml::submitButton('Enlist', array('class'=>'button green')) : CHtml::submitButton('Update', array('class'=>'button blue')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>

<?php
if($model->isNewRecord){
	$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'folder-grid',
			'dataProvider'=>$gridModel->search(),
			'filter'=>$gridModel,
			'columns'=>array(
					'fld_group_name',
					'fld_order',
					array(
						'class'=>'CButtonColumn',
					),
			),
	));
} else{
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'folder-grid',
		'dataProvider'=>$gridModel->search(),
		'columns'=>array(
				'fld_group_name',
				'fld_order',
				array(
					'class'=>'CButtonColumn',
				),
		),
	));
}
?>