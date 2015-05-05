<?php

/**
 * Class UserController
 */
class UserController extends MuserController
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
	 * @return array
	 */
	public function filters()
	{
		return [
			'accessControl', // perform access control for CRUD operations
		];
	}

	/**
	 * @return array
	 */
	public function accessRules()
	{
		return [
			['allow',
				'roles' => [Users::ROLE_ADMIN, Users::ROLE_MUSER, Users::ROLE_CHASHKA],
			],
			['deny',
				'users' => ['*'],
			],
		];
	}

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
	    $modelPrivateInfoForm = new PrivateInfoForm();
	    $modelPrivateInfoForm->setAttributes($this->modelUser->getAttributes());

	    if (Yii::app()->request->isPostRequest) {
		    $post = Yii::app()->request->getPost(get_class($modelPrivateInfoForm));
		    $oldPhoto = $modelPrivateInfoForm->photo;
		    $modelPrivateInfoForm->setAttributes($post);

		    if ($modelPrivateInfoForm->save()) {
			    if ($oldPhoto != $modelPrivateInfoForm->photo) {
				    $photoPath = $modelPrivateInfoForm->photo;
				    $photoArray = explode('/', $photoPath);
				    $photoName = $photoArray[count($photoArray) - 1];
				    $photoNameArray = explode('.', $photoName);
				    $extension = 'png';
				    if (isset($photoNameArray[count($photoNameArray) - 1])) {
					    $extension = $photoNameArray[count($photoNameArray) - 1];
				    }

				    $image = new EasyImage($photoPath);
				    $image->resize(120, 75, EasyImage::RESIZE_PRECISE);

				    $file = md5(date('YmdHism')) . '.' .$extension;

				    $directory = Yii::app()->params['admin']['files']['mu'];
				    $image->save($directory . $file);

				    $modelPrivateInfoForm->photo = $directory . $file;
				    $modelPrivateInfoForm->save(false);

				    if (file_exists($photoPath)) {
					    unlink($photoPath);
				    }

				    if (file_exists($directory . $oldPhoto) && !empty($oldPhoto)) {
					    unlink($directory . $oldPhoto);
				    }
			    }

			    Yii::app()->user->setFlash('success', Yii::t('main', 'Спасибо. Информация сохранена'));
		    } else {
			    Yii::app()->user->setFlash('error', Yii::t('error', 'Вы допустили ошибки. Исправьте их пожалуйста'));
		    };
	    }

        $this->render('index', [
	        'modelPrivateInfoForm' => $modelPrivateInfoForm
        ]);
    }

	/**
	 *
	 */
	public function actionEmail()
	{
		$modelChangeEmailForm = new ChangeEmailForm();

		if (Yii::app()->request->isPostRequest) {
			$post = Yii::app()->request->getPost(get_class($modelChangeEmailForm));

			$modelChangeEmailForm->setAttributes($post);

			if ($modelChangeEmailForm->save()) {
				Yii::app()->user->setFlash('success', Yii::t('main', 'Спасибо. E-Mail изменен'));

				$modelChangeEmailForm = new ChangeEmailForm();
			} else {
				Yii::app()->user->setFlash('error', Yii::t('error', 'Вы допустили ошибки. Исправьте их пожалуйста'));
			}
		}

		$this->render('email', [
			'modelChangeEmailForm' => $modelChangeEmailForm
		]);
	}

	/**
	 *
	 */
	public function actionPassword()
	{
		$modelChangePasswordForm = new ChangePasswordForm();

		if (Yii::app()->request->isPostRequest) {
			$post = Yii::app()->request->getPost(get_class($modelChangePasswordForm));

			$modelChangePasswordForm->setAttributes($post);

			if ($modelChangePasswordForm->save()) {
				Yii::app()->user->setFlash('success', Yii::t('main', 'Спасибо. Пароль изменен'));

				$modelChangePasswordForm = new ChangePasswordForm();
			} else {
				Yii::app()->user->setFlash('error', Yii::t('error', 'Вы допустили ошибки. Исправьте их пожалуйста'));
			}
		}

		$this->render('password', [
			'modelChangePasswordForm' => $modelChangePasswordForm
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