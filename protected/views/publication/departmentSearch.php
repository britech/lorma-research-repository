<?php
$this->breadcrumbs=array(
		'Publications'=>array('index'),
		'Department Search'
);
$this->menu=array(
		array('label'=>'Search a Publication', 'url'=>array('search')),
);
?>
<h1>Listing research publications under the
	<span style="text-decoration: underline;"><?php echo $name;?></span>
</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name'=>'Publication Title',
			'value'=>'$data->fld_pub_title',
			'sortable'=>false
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>