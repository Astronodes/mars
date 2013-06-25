<?php
class RbacCommand extends CConsoleCommand
{
   
    private $_authManager;
 
    
	public function getHelp()
	{
		
		$description = "DESCRIPTION\n";
		$description .= '    '."This command generates an initial RBAC authorization hierarchy.\n";
		return parent::getHelp() . $description;
	}
 
	
	/**
	 * The default action - create the RBAC structure.
	 */
	public function actionIndex()
	{
		 
		$this->ensureAuthManagerDefined();
		
		//provide the oportunity for the use to abort the request
		$message = "This command will create three roles: Admin and Member\n";
		$message .= " and the following permissions:\n";
		$message .= "create, update, delete and admin Project\n";
		$message .= "create, view, update, delete and admin User\n";
		$message .= "create, update, delete and admin Post\n";
		$message .= "update, delete, approve and admin Comment\n";
		$message .= "create, update, delete and admin Member\n";
		$message .= "Would you like to continue?";
	    
	    //check the input from the user and continue if 
		//they indicated yes to the above question
	    if($this->confirm($message)) 
		{
		     //first we need to remove all operations, 
			 //roles, child relationship and assignments
			 $this->_authManager->clearAll();
 
			 //create the lowest level operations for projects
			 $this->_authManager->createOperation(
				"createProject",
				"create a new project"); 
			 $this->_authManager->createOperation(
				"updateProject",
				"update an existing project"); 
			 $this->_authManager->createOperation(
				"deleteProject",
				"delete a current project"); 
			 $this->_authManager->createOperation(
				"adminProject",
				"Administer All Projects"); 
 
			 //create the lowest level operations for users
			 $this->_authManager->createOperation(
				"viewUser",
				"View user information"); 
			 $this->_authManager->createOperation(
				"createUser",
				"Create a new user"); 
	 		 $this->_authManager->createOperation(
				"updateUser",
				"update user information"); 
			 $this->_authManager->createOperation(
				"deleteUser",
				"delete a user"); 
  			$this->_authManager->createOperation(
				"indexUser",
				"view all users"); 
  			 $this->_authManager->createOperation(
				"adminUser",
				"Admin all users"); 
 
 
			 //create the lowest level operations for Posts
			 $this->_authManager->createOperation(
				"createPost",
				"create a new post"); 
			 $this->_authManager->createOperation(
				"updatePost",
				"update post information"); 
			 $this->_authManager->createOperation(
				"deletePost",
				"delete post"); 
			 $this->_authManager->createOperation(
				"adminPost",
				"Admin Posts");     
 
  			//create the lowest level operations for Comments
			 $this->_authManager->createOperation(
				"updateComment",
				"update comment information"); 
			 $this->_authManager->createOperation(
				"deleteComment",
				"delete comment"); 
			 $this->_authManager->createOperation(
				"adminComment",
				"admin comments"); 
			 $this->_authManager->createOperation(
				"approveComment",
				"Approve pending comments");

			 //create the lowest level operations for Members
			 $this->_authManager->createOperation(
				"createMember",
				"create a new member"); 
			 $this->_authManager->createOperation(
				"updateMember",
				"update member information"); 
			 $this->_authManager->createOperation(
				"deleteMember",
				"delete member"); 
			 $this->_authManager->createOperation(
				"adminMember",
				"Admin Member");   
			 //create the member role and add the appropriate 
			 //permissions as children to this role
			 $role=$this->_authManager->createRole("member"); 
			 $role->addChild("createProject");
			 $role->addChild("updateProject");
			 $role->addChild("deleteProject"); 
			 $role->addChild("adminProject"); 
			 $role->addChild("viewUser");
			 $role->addChild("indexUser");
			 $role->addChild("createPost");
			 $role->addChild("updatePost");
			 $role->addChild("deletePost");
			 $role->addChild("adminPost");
			 $role->addChild("updateComment");
			 $role->addChild("deleteComment");
			 $role->addChild("adminComment");    
			 $role->addChild("approveComment");
			 $role->addChild("createMember");
			 $role->addChild("updateMember");


 
			 //create the admin role, and add the appropriate 
			 //permissions, as well as the member role itself, as children
			 $role=$this->_authManager->createRole("admin"); 
			 $role->addChild("member"); 
			 $role->addChild("deleteMember"); 
			 $role->addChild("createUser"); 
			 $role->addChild("updateUser");
			 $role->addChild("deleteUser");
			 $role->addChild("adminUser");

			 //assign TEST3 as admin role
			 $this->_authManager->assign('admin', 4);
 
		
		     //provide a message indicating success
		     echo "Authorization hierarchy successfully generated.\n";
        }
 		else
			echo "Operation cancelled.\n";
    }
 
	public function actionDelete()
	{
		$this->ensureAuthManagerDefined();
		$message = "This command will clear all RBAC definitions.\n";
		$message .= "Would you like to continue?";
	    //check the input from the user and continue if they indicated 
	    //yes to the above question
	    if($this->confirm($message)) 
	    {
			$this->_authManager->clearAll();
			echo "Authorization hierarchy removed.\n";
		}
		else
			echo "Delete operation cancelled.\n";
			
	}
	
	protected function ensureAuthManagerDefined()
	{
		//ensure that an authManager is defined as this is mandatory for creating an auth heirarchy
		if(($this->_authManager=Yii::app()->authManager)===null)
		{
		    $message = "Error: an authorization manager, named 'authManager' must be con-figured to use this command.";
			$this->usageError($message);
		}
	}
}