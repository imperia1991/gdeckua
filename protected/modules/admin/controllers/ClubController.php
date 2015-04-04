<?php

/**
 * Class ClubController
 */
class ClubController extends AdminController
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

	public function actions()
	{
		return [
			'imageUpload' => [
				'class'        => 'ext.redactor.actions.ImageUpload',
				'uploadPath'   => Yii::app()->params['admin']['files']['ch'],
				'uploadUrl'    => Yii::app()->params['siteUrl'] . Yii::app()->params['admin']['files']['ch'],
				'uploadCreate' => true,
				'permissions'  => 0755,
			],
			'imageList'   => [
				'class'      => 'ext.redactor.actions.ImageList',
				'uploadPath' => Yii::app()->params['admin']['files']['ch'],
				'uploadUrl'  => Yii::app()->params['siteUrl'] . Yii::app()->params['admin']['files']['ch'],
			],
		];
	}

	/**
	 *
	 */
	public function init()
	{
		parent::init();

		$this->menuActive = 'club';

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

	/**
	 * Создание новости
	 */
	public function actionCreate()
	{
		$clubModel = new NewsChaska();

		$this->processForm($clubModel);
	}

	/** @var NewsChaska $clubModel */
	private function processForm($clubModel)
	{
		Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

		$clubModel->type = NewsChaska::TYPE_MEETING;

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

				$this->redirect($this->createUrl('/admin/club'));
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

		$directory = Yii::app()->params['admin']['files']['ch'] . '/' . date('dmY') . '/';
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
}