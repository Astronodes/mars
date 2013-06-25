<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>
 
<?php 
if(!Yii::app()->user->isGuest)
{
$this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/admin/default/index')),
                array('label'=>'Projects', 'url'=>'#', 'items'=>array(
                	array('label'=>'Create New', 'url'=>array('/admin/project/create')),
                	array('label' => 'Administer', 'url'=> array('/admin/project/admin'))
                	)),
                array('label'=>'Users', 'url'=>'#', 'items'=>array(
                	array('label'=>'Create New', 'url'=>array('/admin/user/create')),
                	array('label' => 'Administer', 'url'=> array('/admin/user/admin'))
                	)),
                array('label'=>'Posts', 'url'=>'#', 'items'=>array(
                    array('label'=>'Create New', 'url'=>array('/admin/post/create')),
                    array('label' => 'Administer', 'url'=> array('/admin/post/admin'))
                    )),
                array('label'=>'Members', 'url'=>'#', 'items'=>array(
                    array('label'=>'Create New', 'url'=>array('/admin/member/create')),
                    array('label' => 'Administer', 'url'=> array('/admin/member/admin'))
                    )),
                 array('label'=>'Approve Comments' . ' (' . Comment::model()->pendingCommentCount . ')', 'url'=>array('/admin/comment/index')),
                    
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('default/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButton',
            'label' => 'Logout ('.Yii::app()->user->name.')',
            'htmlOptions' => array(
                'data-toggle' => 'modal',
                'data-target' => '#myModal',
                ),
            ),
    ),
)); }
?>
<!-- MODAL CODE -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Logout</h4>
</div>
 
<div class="modal-body">
    <p>Are you sure you want to log out?</p>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Yes',
        'url'=>array('default/logout/'),
       // 'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'No',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>
<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" ?>
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
