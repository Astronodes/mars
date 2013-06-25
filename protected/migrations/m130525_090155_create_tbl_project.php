<?php

class m130525_090155_create_tbl_project extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_project', array(
			'id' => 'pk',
			'title' => 'string NOT NULL',
			'description' => 'text',
			'link' => 'varchar(100)',
			'images' => 'varchar(140)',
			'create_user_id' => 'int(5) DEFAULT NULL',
			'create_time' => 'datetime DEFAULT NULL',
			'update_user_id' => 'int(5) DEFAULT NULL',
			'update_time' => 'datetime DEFAULT NULL',
			), 'ENGINE=InnoDB');
	}

	public function down()
	{
		echo "m130525_090155_create_tbl_project does not support migration down.\n";
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