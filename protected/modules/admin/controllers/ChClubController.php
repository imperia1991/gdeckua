<?php

/**
 * Class ChClubController
 */
class ChClubController extends AdminController
{
	public function actions()
	{
		return [
			'imageUpload' => [
				'class'        => 'ext.redactor.actions.ImageUpload',
				'uploadCreate' => true,
			],
			'imageList'   => [
				'class' => 'ext.redactor.actions.ImageList',
			],
		];
	}

	/**
	 *
	 */
	public function init()
	{
		parent::init();

		$this->menuActive = 'chClub';

		Yii::import('application.extensions.LocoTranslitFilter');
	}

	/**
	 * Список новостей
	 */
	public function actionIndex()
	{
		$clubModel       = new NewsChaska();
		$clubModel->type = NewsChaska::TYPE_CLUB;

		if (Yii::app()->request->isAjaxRequest) {
			$get = Yii::app()->request->getQuery('NewsChaska');

			$clubModel->setAttributes($get);
		}

		$this->render(
			'index',
			[
				'clubModel' => $clubModel,
			]
		);
	}

	/** @var NewsChaska $clubModel */
	private function processForm($clubModel)
	{
		Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

		$clubModel->type = NewsChaska::TYPE_CLUB;

		if (Yii::app()->request->isPostRequest) {
			$post     = Yii::app()->request->getPost('NewsChaska');
			$oldPhoto = $clubModel->photo;

			$clubModel->setAttributes($post);

			$isNewRecord = $clubModel->isNewRecord;

			$newPhoto = $clubModel->photo;

			if ($oldPhoto != $newPhoto) {
				$clubModel->photo = uniqid() . '.' . pathinfo($clubModel->photo, PATHINFO_EXTENSION);
			}

			if ($clubModel->save()) {
				Yii::app()->user->setFlash('success', $isNewRecord ? Yii::t('admin', 'Новость добавлена') : Yii::t('admin', 'Новость изменена'));

				$this->redirect($this->createUrl('/admin/chClub'));
			} else {
				Yii::app()->user->setFlash('error', Yii::t('admin', 'Допущены ошибки. Исправьте их'));
			}
		}

		$this->render(
			'form',
			[
				'clubModel' => $clubModel,
			]
		);
	}

	/**
	 * Обновление новости
	 */
	public function actionUpdate()
	{
		$id = Yii::app()->request->getQuery('id', 0);

		$clubModel = NewsChaska::model()->findByPk((int) $id);

		$this->processForm($clubModel);
	}

	/**
	 * Удаление новости
	 */
	public function actionDelete()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$id = Yii::app()->request->getQuery('id');

			NewsChaska::model()->updateByPk((int) $id, [
				'status' => NewsChaska::STATUS_DELETED
			]);

			Yii::app()->user->setFlash('success', Yii::t('admin', 'Новость удалена'));

			Yii::app()->end();
		}
	}

	/**
	 * Загрузка фотографий заседания на сервер
	 */
	public function actionUploadPhotos()
	{
		Yii::import("ext.EAjaxUpload.qqFileUploader");

		$uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app()->params['admin']['images']['sizeLimit']);
		$result   = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

		$photoPath = Yii::app()->params['admin']['files']['tmp'] . $result['filename'];

		$image = new EasyImage($photoPath, Yii::app()->easyImage->driver);

		$directory = Yii::app()->params['admin']['files']['ch'] . date('dmY') . '/';
		if ( !file_exists($directory)) {
			mkdir($directory, 0775, true);
		}

		$image->resize(510, 340, EasyImage::RESIZE_AUTO);
		$image->save($directory . $result['filename']);

		if (file_exists($photoPath)) {
			unlink($photoPath);
		}

		unset($image);

		$result['filePath'] = '/' . $directory . $result['filename'];

		$this->respondJSON($result);
	}

	public function actionImageUpload()
	{
		$image    = CUploadedFile::getInstanceByName('file');
		$filename = 'a_' . date('YmdHis') . '_' . substr(md5(time()), 0, rand(7, 13)) . '.' . $image->extensionName;
		$photoPath = Yii::app()->params['admin']['files']['tmp'] . $filename;
		$image->saveAs($photoPath);

		$directory = Yii::app()->params['admin']['files']['ch'] . date('dmY');
		if ( !file_exists($directory)) {
			mkdir($directory, 0775, true);
		}

		$image = new EasyImage($photoPath, Yii::app()->easyImage->driver);
		$image->resize(360, 250, EasyImage::RESIZE_AUTO);
		$image->save($directory . $filename);

		if (file_exists($photoPath)) {
			unlink($photoPath);
		}

		unset($image);

		$array = [
			'filelink' => '/' . $directory . $filename,
			'filename' => $filename
		];
		echo stripslashes(json_encode($array));
	}
}