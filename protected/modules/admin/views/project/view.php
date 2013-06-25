<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Update Project', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Project', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h1>View Project #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'link',
		'images',
		'create_user_id',
		'create_time',
		'update_user_id',
		'update_time',
	),
)); ?>

<?php if(isset($dump)) print_r($dump); ?>
<?php foreach ($model->getactiveImages() as $imageL)
      echo "<img src='" . $imageL  . "'> <br />"; ?>

<?php 
