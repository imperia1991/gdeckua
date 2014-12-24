<?php

class ElfinderController extends AdminController
{
	public function actions()
	{
		return array(
			'connector' => array(
				'class' => 'ext.elFinder.ElFinderConnectorAction',
				'settings' => array(
					'root' => Yii::getPathOfAlias('webroot') . '/uploads/photos/',
					'URL' => Yii::app()->baseUrl . '/uploads/photos/',
					'rootAlias' => 'Site',
					'mimeDetect' => 'none',
					'id' => 'none'
				)
			),
		);
	}

}