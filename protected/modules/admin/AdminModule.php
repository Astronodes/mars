<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));

		$this->setComponents(array(
			'errorHandler' => array(
				'errorAction' => 'admin/default/error'),
			'user' => array(
				'class' => 'CWebUser',
				'loginUrl' => Yii::app()->createUrl('admin/default/login'),
				)
			));
		Yii::app()->theme = "bootstrap";
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			$route = $controller->id . '/' . $action->id;
			$publicPages = array('default/login', 'default/error');
		if(Yii::app()->user->isGuest && !in_array($route, $publicPages)){
			Yii::app()->getModule('admin')->user->loginRequired();
			//Yii::app()->request->redirect(Yii::app()->createUrl('admin/default/login'));
		}
			else 	
						// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
