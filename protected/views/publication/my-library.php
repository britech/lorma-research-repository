<?php
$this->breadcrumbs=array(
		'My Library'
);
?>
<h1>My Library</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name'=>'Publication Title',
			'value'=>'$data->publication->fld_pub_title',
			'sortable'=>false
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'viewButtonUrl'=>'array("view","id"=>$data->publication->key_pub)'
		),
	),
	'emptyText'=>'No publications added in your library.'
)); ?>