<?php

class m140428_151012_create_tablse_feedback extends CDbMigration
{
	public function up()
	{
        $this->createTable('feedback', array(
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL',
            'email' => 'VARCHAR(255) NOT NULL',
            'message' => 'TEXT NOT NULL',
            'created_at' => 'DATETIME NOT NULL',
            'is_reading' => 'TINYINT(1) DEFAULT 0',
            'is_answer' => 'TINYINT(1) DEFAULT 0',
        ));
	}

	public function down()
	{
		echo "m140428_151012_create_tablse_feedback does not support migration down.\n";
		return true;
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