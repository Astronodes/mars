<?php

class m130602_082127_create_tbl_members extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_member', array(
			'id' => 'pk',
			'name' => 'varchar(64) NOT NULL',
			'description' => 'text NOT NULL',
			'user_id' => 'int(11) DEFAULT NULL',
			'job_title' => 'varchar(20) DEFAULT NULL',
			'member_status' => 'int(1)',
			'create_user_id' => 'int(11) DEFAULT NULL',
			'create_time' => 'datetime DEFAULT NULL',
			'update_user_id' => 'int(11) DEFAULT NULL',
			'update_time' => 'datetime DEFAULT NULL',

			 ), 'ENGINE=InnoDB');
		$this->addForeignKey('fk_user_id', 'tbl_member', 'user_id', 'tbl_user', 'id', 'SET NULL', 'CASCADE');
	
	}

	public function down()
	{
		echo "m130602_082127_create_tbl_members does not support migration down.\n";
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