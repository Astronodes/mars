<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	<script src="<?php echo Yii::app()->baseUrl. '/resources/ckeditor/ckeditor.js'; ?> "></script>
	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('id'=>'editor1')); ?>
		<?php echo $form->error($model,'content'); ?> 
		<?php //echo $form->labelEx($model,'content'); ?>
		<?php //echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php //echo $form->error($model,'content'); ?>
	</div>
	<script type="text/javascript">
    CKEDITOR.replace( 'editor1', {
         filebrowserBrowseUrl: '<?php echo Yii::app()->baseUrl; ?>/resources/kcfinder/browse.php?type=files',
         filebrowserImageBrowseUrl: '<?php echo Yii::app()->baseUrl; ?>/resources/kcfinder/browse.php?type=images',
         filebrowserFlashBrowseUrl: '<?php echo Yii::app()->baseUrl; ?>/resources/kcfinder/browse.php?type=flash',
         filebrowserUploadUrl: '<?php echo Yii::app()->baseUrl; ?>/resources/kcfinder/upload.php?type=files',
         filebrowserImageUploadUrl: '<?php echo Yii::app()->baseUrl; ?>/resources/kcfinder/upload.php?type=images',
         filebrowserFlashUploadUrl: '<?php echo Yii::app()->baseUrl; ?>/resources/kcfinder/upload.php?type=flash'
    });
</script>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', Lookup::items('postStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php echo $form->textArea($model,'tags',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'tags'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->