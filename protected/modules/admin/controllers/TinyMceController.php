<?php

Yii::import('ext.tinymce.*');

class TinyMceController extends AdminController
{

	public function accessRules()
	{
		return [
			['allow',
				'roles' => [Users::ROLE_ADMIN, Users::ROLE_CHASHKA, Users::ROLE_MUSER],
			],
			['deny', // deny all users
				'users' => ['*'],
			],
		];
	}

	public function actions()
	{
		return array(
			'compressor' => array(
				'class' => 'TinyMceCompressorAction',
				'settings' => array(
					'compress' => true,
					'disk_cache' => true,
				)
			),
			'spellchecker' => array(
				'class' => 'TinyMceSpellcheckerAction',
			),
		);
	}

}