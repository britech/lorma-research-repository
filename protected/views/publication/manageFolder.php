<?php
//TODO put the page title
$this->breadcrumbs=array(
		'Publications'=>array('index'),
		'Publication Information'=>array('publication/view', 'id'=>$model->key_pub),
		'Folders'
);

$this->profileLink=array(
		array('label'=>'Authors', 'url'=>array('publication/author', 'publication'=>$model->key_pub)),
		array('label'=>'Folders', 'url'=>array('publication/folder', 'publication'=>$model->key_pub)),
		array('label'=>'Files', 'url'=>array('publication/file', 'publication'=>$model->key_pub)),
		array('label'=>'Keywords', 'url'=>array('publication/keyword', 'publication'=>$model->key_pub)),
);

$this->menu=array(
		array('label'=>'Update Publication', 'url'=>array('update', 'id'=>$model->key_pub)),
		array('label'=>'Delete Publication', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->key_pub),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Publication Directory', 'url'=>array('index')),
		array('label'=>'Upload a Publication', 'url'=>array('create')),
		array('label'=>'Search a Publication', 'url'=>array('search')),
);
?>
<h1>Folders</h1>
<div class="form">
<?php if(count($folderList) > 0):?>
	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'pub-folder-form',
			'action'=>array('publication/assignFolder', 'publication'=>$model->key_pub),
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
			<?php echo $form->labelEx($model,'key_folder_group'); ?>
			<?php echo $form->dropDownList($model,'key_folder_group',$folderList); ?>
			<?php echo $form->error($model,'key_folder_group'); ?>
			<?php echo $form->hiddenField($model, 'key_pub');?>
		</div>
		
		<div class="row buttons">
			<?php echo CHtml::submitButton('Assign', array('class'=>'button green')); ?>
		</div>
	<?php $this->endWidget();?>

<?php else:?>
	<p>Oops! It seems all folder definitions have been used up on this publication. 
	Please define new folder definitons if you want to link more folders in this publication or remove the linked folders.</p>
<?php endif;?>
</div>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'pub-folder-grid',
		'dataProvider'=>$gridModel->search($model->key_pub),
		'columns'=>array(
				array(
					'name'=>'key_folder_group',
					'value'=>'$data->folder->fld_group_name',
					'htmlOptions'=>array('style'=>'width:70%'),
					'sortable'=>false
				),
				array(
					'header'=>'Action',
					'class'=>'CButtonColumn',
					'template'=>'{delete}',
					'deleteButtonUrl'=>'array("publication/removeFolder","id"=>$data->key_pub_folder)',
					'afterDelete'=>'function(link, success, data){ if(success) window.location=window.location}'
				),
		),
		'emptyText'=>'No folders linked',
		'summaryText'=>''
)); ?>