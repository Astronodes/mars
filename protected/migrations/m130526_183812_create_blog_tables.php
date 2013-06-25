<?php

class m130526_183812_create_blog_tables extends CDbMigration
{
	public function up()
	{
		//create the blog posts table
		$this->createTable('tbl_post', array(
			'id' => 'pk',
			'title' => 'varchar(128) NOT NULL',
			'content' => 'text NOT NULL',
			'status' => 'int(1)',
			'tags' => 'text',
			'create_time' => 'datetime DEFAULT NULL',
			'create_user_id' => 'int(11) DEFAULT NULL',
			'update_time' => 'datetime DEFAULT NULL',
			'update_user_id' => 'int(11) DEFAULT NULL',
			), 'ENGINE=InnoDB');
		$this->addForeignKey("fk_post_author", "tbl_post", "create_user_id", "tbl_user", "id", "CASCADE", "RESTRICT");

		//create the comments table

		$this->createTable('tbl_comment', array(
			'id' => 'pk',
			'post_id' => 'int(11) NOT NULL',
			'comment_author' => 'varchar(128) NOT NULL',
			'content' => 'text NOT NULL',
			'status' => 'int(1) NOT NULL',
			'email' => 'varchar(128) DEFAULT NULL',
			'url' => 'varchar(128) DEFAULT NULL',
			'create_time' => 'datetime DEFAULT NULL',
			'update_time' => 'datetime DEFAULT NULL',
			), 'ENGINE=InnoDB');
		//add FK to link to blog
		$this->addForeignKey("fk_comment_post", "tbl_comment", "post_id", "tbl_post", "id", "CASCADE", "RESTRICT");


		//create tbl_tag to store all tags information

		$this->createTable("tbl_tag", array(
			'id' => 'pk',
			'name' => 'varchar(128) NOT NULL',
			'frequency' => 'int DEFAULT 1',
			), 'ENGINE=InnoDB');

		//create tbl_lookup to store all text information related to status codes

		$this->createTable('tbl_lookup', array(
			'id' => 'pk',
			'name' => 'varchar(128) NOT NULL',
			'code' => 'int NOT NULL',
			'type' => 'varchar(128) NOT NULL',
			'position' => 'int NOT NULL',
			), 'ENGINE=InnoDB');

		$this->insert('tbl_lookup', array('name' => 'Draft', 'type' => 'PostStatus', 'code' => 1, 'position' => 1));
		$this->insert('tbl_lookup', array('name' => 'Published', 'type' => 'PostStatus', 'code' => 2, 'position' => 2));
		$this->insert('tbl_lookup', array('name' => 'Archived', 'type' => 'PostStatus', 'code' => 3, 'position' => 3));
		$this->insert('tbl_lookup', array('name' => 'Pending Approval', 'type' => 'CommentStatus', 'code' => 1, 'position' => 1));
		$this->insert('tbl_lookup', array('name' => 'Approved', 'type' => 'CommentStatus', 'code' => 2, 'position' => 2));

		
	}

	public function down()
	{
		echo "m130526_183812_create_blog_tables does not support migration down.\n";
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