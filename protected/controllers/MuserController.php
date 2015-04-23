<?php

/**
 * Class MuserController
 */
class MuserController extends Controller
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
		$this->render('password', []);
	}

    /**
     * @throws CHttpException
     */
    public function actionView()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $newsModel = News::model()->findByPk($id);

        if (null === $newsModel) {
            throw new CHttpException(404);
        }

        /** @var News[] $newsModels  */
        $comment = new CommentsNews(CommentsNews::SCENARIO_USER);

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('CommentsNews', []);

            $comment->setAttributes($post);
            $comment->message = nl2br($comment->message);
            $comment->news_id = $newsModel->id;
            $comment->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());

            if ($comment->save()) {
                Yii::app()->user->setFlash('success', Yii::t('main', 'Спасибо. Ваш комментарий добавлен'));

                $comment = new CommentsNews(CommentsNews::SCENARIO_USER);
            } else {
                Yii::app()->user->setFlash('error', Yii::t('main', 'Вы допустили ошибки при добавлении комментария'));
            }
        }

        $this->render(
            'view',
            [
                'newsModel' => $newsModel,
                'comment' => $comment
            ]
        );
    }

	/**
	 * Загрузка изображений во временную папку
	 */
	public function actionUpload()
	{
		Yii::import("ext.EAjaxUpload.qqFileUploader");

		$uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app()->params['admin']['images']['sizeLimit']);
		$result = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);
		$result['filename'] = '/' . Yii::app()->params['admin']['files']['tmp'] . $result['filename'];

		$this->respondJSON($result);
	}

}