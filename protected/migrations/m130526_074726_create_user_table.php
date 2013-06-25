<?php

class m130526_074726_create_user_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_user', array(
			'id' => 'pk',
			'username' => 'string NOT NULL',
			'email' => 'string NOT NULL',
			'password' => 'string NOT NULL',
			'last_login_time' => 'datetime DEFAULT NULL',
			'create_time' => 'datetime DEFAULT NULL',
			'create_user_id' => 'int(11) DEFAULT NULL',
			'update_time' => 'datetime DEFAULT NULL',
			'update_user_id' => 'int(11) default NULL',
			), 'ENGINE=InnoDB');

			
	}

	public function down()
	{
		echo "m130526_074726_create_user_table does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}