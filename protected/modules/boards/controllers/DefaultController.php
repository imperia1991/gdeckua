<?php

class DefaultController extends BoardController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}