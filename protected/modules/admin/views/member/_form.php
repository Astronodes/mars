<?php
/* @var $this MemberController */
/* @var $model Member */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($model, $photos)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->dropDownList($model,'user_id', $model->getUsernames()); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'job_title'); ?>
		<?php echo $form->textField($model,'job_title',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'job_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'member_status'); ?>
		<?php echo $form->dropDownList($model,'member_status', lookUp::items('memberStatus')); ?>
		<?php echo $form->error($model,'member_status'); ?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->