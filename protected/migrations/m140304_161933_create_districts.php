<?php

class m140304_161933_create_districts extends CDbMigration
{
	public function up()
	{
        $this->createTable('districts', array(
            'id' => 'pk',
            'city_id' => 'INT DEFAULT 2642',
            'title_ru' => 'VARCHAR (255) NOT NULL',
            'title_uk' => 'VARCHAR (255) NOT NULL',
        ));

        $this->addColumn('places', 'district_id', 'INT NOT NULL');

        $this->addForeignKey('districts_cities_city_id', 'districts', 'city_id', 'cities', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('places_districts_district_id', 'places', 'district_id', 'districts', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('places_districts_district_id', 'places');
        $this->dropForeignKey('districts_cities_city_id', 'districts');

        $this->dropColumn('places', 'district_id');

        $this->dropTable('districts');

		echo "m140304_161933_create_districts does not support migration down.\n";
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