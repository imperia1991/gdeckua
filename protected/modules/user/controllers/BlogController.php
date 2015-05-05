<?php

/**
 * Class BlogController
 */
class BlogController extends MuserController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->currentPageType = PageTypes::PAGE_MUSER;

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
	    $modelBlog = new Blog();

        $this->render('index', [
	        'modelBlog' => $modelBlog
        ]);
    }

	public function actionAdd()
	{
		$modelBlog = new Blog();

		$this->render('add', [
			'modelBlog' => $modelBlog
		]);
	}
	/**
	 * Загрузка фото на странице
	 */
	public function actionUpload()
	{
		Yii::import("ext.EAjaxUpload.qqFileUploader");

		$uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app(
		)->params['admin']['images']['sizeLimit']);

		$result = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

		$filePath = '/' . Yii::app()->params['admin']['files']['tmp'] . $result['filename'];
		Yii::app()->session['photoUser'] = $filePath;

		$result['filename'] = $filePath;

		$this->respondJSON($result);
	}
}