<?php

/**
 * Class MeetingController
 */
class MeetingController extends AdminController
{
	public function accessRules()
	{
		return [
			[
				'allow',
				'roles' => [Users::ROLE_ADMIN, Users::ROLE_CHASHKA],
			],
			[
				'deny', // deny all users
				'users' => ['*'],
			],
		];
	}

	/**
	 *
	 */
	public function init()
	{
		parent::init();

		$this->menuActive = 'meeting';

		Yii::import('application.extensions.LocoTranslitFilter');
	}

	/**
	 * Список новостей
	 */
	public function actionIndex()
	{
		$meetingModel       = new NewsChaska();
		$meetingModel->type = NewsChaska::TYPE_MEETING;

		if (Yii::app()->request->isAjaxRequest) {
			$get = Yii::app()->request->getQuery('NewsChaska');

			$meetingModel->setAttributes($get);
		}

		$this->render(
			'index',
			[
				'meetingModel' => $meetingModel,
			]
		);
	}

	/**
	 * Создание новости
	 */
	public function actionCreate()
	{
		$meetingModel       = new NewsChaska();

		$this->processForm($meetingModel);
	}

	/** @var NewsChaska $meetingModel */
	private function processForm($meetingModel)
	{
		$meetingModel->type = NewsChaska::TYPE_MEETING;

		if (Yii::app()->request->isPostRequest) {
			$post     = Yii::app()->request->getPost('NewsChaska');
			$oldPhoto = $meetingModel->photo;

			$meetingModel->setAttributes($post);

			$isNewRecord = $meetingModel->isNewRecord;

			$newPhoto = $meetingModel->photo;

			if ($oldPhoto != $newPhoto) {
				$meetingModel->photo = uniqid() . '.' . pathinfo($meetingModel->photo, PATHINFO_EXTENSION);
			}

			if ($meetingModel->save()) {
				if ($oldPhoto != $newPhoto) {
					$photoPath = Yii::app()->params['admin']['files']['tmp'] . $newPhoto;
					$image     = new EasyImage($photoPath);
					$width = $image->image()->width;
					$height = $image->image()->height;
					$proportional = $width / $height;
					$proportionalSlider = 497 / 290;

					$newWidth = 497;
					$newHeight = 497 / $proportional;
					$image->resize($newWidth, $newHeight, EasyImage::RESIZE_PRECISE);

					$diff = 1 - $proportional / $proportionalSlider;
					if ($width > $height) {
						$image->crop($newWidth, ($newHeight - $newHeight * $diff));
					}

					$directory = Yii::app()->params['admin']['files']['ch'] . '/';

					$image->save($directory . $meetingModel->photo);

					if (file_exists($photoPath)) {
						unlink($photoPath);
					}

					if (file_exists($directory . $oldPhoto) && !empty($oldPhoto)) {
						unlink($directory . $oldPhoto);
					}
				}

				unset(Yii::app()->session['meetingImage']);

				Yii::app()->user->setFlash('success', $isNewRecord ? Yii::t('admin', 'Заседание добавлено') : Yii::t('admin', 'Заседание изменено'));

				$this->redirect($this->createUrl('/admin/meeting'));
			} else {
				Yii::app()->user->setFlash('error', Yii::t('admin', 'Допущены ошибки. Исправьте их'));
			}
		}

		$this->render(
			'form',
			[
				'meetingModel'  => $meetingModel,
			]
		);
	}

	/**
	 * Обновление новости
	 */
	public function actionUpdate()
	{
		$id = Yii::app()->request->getQuery('id', 0);

		$meetingModel = NewsChaska::model()->findByPk((int) $id);

		$this->processForm($meetingModel);
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

			Yii::app()->user->setFlash('success', Yii::t('admin', 'Заседание удалено'));

			Yii::app()->end();
		}
	}

	/**
	 * Загрузка фото для анонса заседания
	 */
	public function actionUpload()
	{
		Yii::import("ext.EAjaxUpload.qqFileUploader");

		$uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app()->params['admin']['images']['sizeLimit']);
		$result   = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

		Yii::app()->session['meetingImage'] = $result['filename'];

		$this->respondJSON($result);
	}

	/**
	 * Загрузка фото для анонса заседания
	 */
	public function actionUploadMeetingPhoto()
	{
		$directory = Yii::app()->params['admin']['files']['ch'] . '/' . date('dmY') . '/';
		$file      = md5(date('YmdHis')) . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

		if (!file_exists($directory)) {
			mkdir($directory, 0777, true);
		}

		$array = [];
		if (move_uploaded_file($_FILES['file']['tmp_name'], $directory . $file)) {
			$array = [
				'filelink' => '/' . $directory . $file
			];
		}

		$this->respondJSON($array);
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

		$directory = Yii::app()->params['admin']['files']['ch'] . '/' . date('dmY') . '/';
		if (!file_exists($directory)) {
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
}