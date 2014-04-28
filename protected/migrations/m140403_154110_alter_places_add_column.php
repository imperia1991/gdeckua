<?php

class m140403_154110_alter_places_add_column extends CDbMigration
{
	public function up()
	{
        return true;
        $this->execute('
				ALTER TABLE `places` CHANGE `description` `description_ru` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT "Описание на русском";
                ALTER TABLE `places` CHANGE `address` `address_ru` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
                ALTER TABLE `places` ADD `description_uk` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT "Описание на украинском";
                ALTER TABLE `places` ADD `address_uk` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
			'
		);
	}

	public function down()
	{
		echo "m140403_154110_alter_places_add_column does not support migration down.\n";
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