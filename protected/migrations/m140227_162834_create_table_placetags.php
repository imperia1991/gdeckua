<?php

class m140227_162834_create_table_placetags extends CDbMigration
{
	public function up()
	{
        $this->createTable('place_tags', array(
            'id' => 'pk',
            'place_id' => 'INT NOT NULL',
            'tags' => 'TEXT NOT NULL',
        ));

        $this->addForeignKey('place_lace_tags_place_id', 'place_tags', 'place_id', 'places', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('place_lace_tags_place_id', 'place_tags');
        $this->dropTable('place_tags');

		echo "m140227_162834_create_table_placetags does not support migration down.\n";
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