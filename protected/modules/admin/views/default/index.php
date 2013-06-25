<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
Welcome <?php echo Yii::app()->user->username ; ?> to the Administration Portal.
Your last login was on <?php echo Yii::app()->user->lastLogin ; ?> .
</p>
