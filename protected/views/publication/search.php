<h1>Search a Publication</h1>

<div class="wide form">
	<?php $form=$this->beginWidget('CActiveForm', array()); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'publicationTitle'); ?>
		<?php echo $form->textField($model,'publicationTitle', array('size'=>125)); ?>
		<?php echo $form->error($model,'publicationTitle'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'departmentOfOrigin'); ?>
		<?php echo $form->dropDownList($model,'departmentOfOrigin', $deptList); ?>
		<?php echo $form->error($model,'departmentOfOrigin'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'authorLastNames'); ?>
		<?php echo $form->textField($model,'authorLastNames', array('size'=>125)); ?>
		<?php echo $form->error($model,'authorLastNames'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'keywords'); ?>
		<?php echo $form->textField($model,'keywords', array('size'=>125)); ?>
		<?php echo $form->error($model,'keywords'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'limit'); ?>
		<?php echo $form->dropDownList($model, 'limit', $model->getPaginationSizes()); ?>
		<?php echo $form->error($model,'limit'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search', array('class'=>'button green')); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name'=>'fld_pub_title',
			'sortable'=>false
		),
		array(
			'name'=>'key_dept',
			'value'=>'$data->department->fld_name',
			'sortable'=>false
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>