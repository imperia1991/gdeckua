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
        $this->render('index', []);
    }

	/**
	 *
	 */
	public function actionEmail()
	{
		$this->render('email', []);
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

}