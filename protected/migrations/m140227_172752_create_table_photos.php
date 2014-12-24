<?php

class m140227_172752_create_table_photos extends CDbMigration
{
	public function up()
	{
        $this->createTable('photos', array(
            'id' => 'pk',
            'place_id' => 'INT NOT NULL',
            'title' => 'VARCHAR(255) NOT NULL',
        ));

        $this->addForeignKey('place_photos_place_id', 'photos', 'place_id', 'places', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('place_photos_place_id', 'photos');
        $this->dropTable('photos');

		echo "m140227_172752_create_table_photos does not support migration down.\n";
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