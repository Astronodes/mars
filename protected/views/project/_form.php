<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'images'); ?>
		<?php $this->widget('CMultiFileUpload', array(
			'name' => 'images',
			'accept' => 'jpg|png',
			'max' => 5,
			'remove' => Yii::t('ui', 'Remove'),
			'denied' => 'type is not allowed',
			'duplicate' => 'file appears twice',
			'htmlOptions' => array('size' =>25),
			
			)); ?>
			<?php echo $form->error($model,'images'); ?>
	</div>

	<div>
		<?php 
		foreach ($model->getImages() as $key=>$value)
		{
			echo $form->checkBox($model, 'checkBox['. $key.']', array('checked'=>'checked','value'=>$value));
			echo'<img src="'. $model->Thumbs[$key]. '" />' ;

		}
		?>
		<?php 
		/*echo $form->checkBoxList($model, 'checkBox', $model->getCheckBoxList(), array(
		'checked' => 'checked',
		'template' => '{input} <img src=""> {label}')); 
		*/?> 
	</div>
		
				
			
	 
	<div class="row">
		<?php echo $form->labelEx($model,'create_user_id'); ?>
		<?php echo $form->textField($model,'create_user_id'); ?>
		<?php echo $form->error($model,'create_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	


	<div class="row">
		<?php echo $form->labelEx($model,'update_user_id'); ?>
		<?php echo $form->textField($model,'update_user_id'); ?>
		<?php echo $form->error($model,'update_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
		<?php echo $form->error($model,'update_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>



</div><!-- form -->