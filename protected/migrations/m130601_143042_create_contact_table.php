<?php

class m130601_143042_create_contact_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_contact', array(
			'id' => 'pk',
			'name' => 'varchar(64) NOT NULL',
			'email' => 'varchar(64) NOT NULL',
			'reason' => 'int(1)',
			'phone' => 'varchar(20) DEFAULT NULL',
			'body' => 'text NOT NULL',
			'subject' => 'varchar(64)',
			), 'ENGINE=InnoDB');

	}

	public function down()
	{
		echo "m130601_143042_create_contact_table does not support migration down.\n";
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