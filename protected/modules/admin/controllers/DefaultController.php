<?php

/**
 * Class DefaultController
 */
class DefaultController extends AdminController
{
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
			['deny', // deny all users
				'users' => ['*'],
			],
		];
	}

	/**
	 *
	 */
	public function actionIndex()
    {
	    if (Yii::app()->user->checkAccess(Users::ROLE_ADMIN)) {
		    $this->redirect('/admin/news');
	    }

	    if (Yii::app()->user->checkAccess(Users::ROLE_CHASHKA)) {
		    $this->redirect('/admin/meeting');
	    }

	    if (Yii::app()->user->checkAccess(Users::ROLE_MUSER)) {
		    $this->redirect('/admin/blog');
	    }

        $this->render('index');
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}