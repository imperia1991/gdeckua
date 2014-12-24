<?php

class m140512_161635_create_table_statistics extends CDbMigration
{
	public function up()
	{
        $this->createTable('word_statistics', array(
            'id' => 'pk',
            'words' => 'VARCHAR(255)'
        ));
	}

	public function down()
	{
        $this->dropTable('word_statistics');

		echo "m140512_161635_create_table_statistics does not support migration down.\n";
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