<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Posts',
);

$this->menu=array(
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h1>Posts <?php echo (isset($_GET['tag'])? ' tagged with '. $_GET['tag']:''); ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
