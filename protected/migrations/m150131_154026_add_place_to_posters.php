<?php

class m150131_154026_add_place_to_posters extends CDbMigration
{
	public function up()
	{
//		$this->addColumn('posters', 'place_id', 'INT DEFAULT NULL');
//		$this->addForeignKey()
	}

	public function down()
	{
		echo "m150131_154026_add_place_to_posters does not support migration down.\n";
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