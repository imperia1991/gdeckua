<?php

/**
 * Class ChashkaCheController
 */
class ChashkaCheController extends Controller
{

	/**
	 *
	 */
	public function init()
	{
		parent::init();

		$this->currentPageType = PageTypes::PAGE_CHASHKA_CHE;
	}

	/**
	 * Declares class-based actions.
	 */
//    public function actions()
//    {
//        return [
//            // captcha action renders the CAPTCHA image displayed on the contact page
//            'captcha' => [
//                'class' => 'CCaptchaAction',
//                'backColor' => 0x494949,
//                'foreColor' => 0xFFFFFF
//            ],
//        ];
//    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$meetings = NewsChaska::model()->getAll(NewsChaska::TYPE_MEETING);
		$clubs    = NewsChaska::model()->getAll(NewsChaska::TYPE_CLUB);

		if (Yii::app()->request->isAjaxRequest) {
			$this->processPageRequest('page');

			$this->respondJSON(
				[
					'meetingView' => $this->renderPartial(
						'/chashkaChe/partials/_meetingView',
						[
							'meetings' => $meetings,
							'page'     => Yii::app()->getRequest()->getQuery('page', 0)
						], true
					),
					'clubView'    => $this->renderPartial(
						'/chashkaChe/partials/_clubView',
						[
							'clubs' => $clubs,
							'page'  => Yii::app()->getRequest()->getQuery('page', 0)
						], true
					)
				]
			);
		}

		$this->render(
			'index',
			[
				'meetings' => $meetings,
				'clubs'    => $clubs,
			]
		);
	}

	/**
	 * @throws CHttpException
	 */
	public function actionView()
	{
		$alias = Yii::app()->request->getQuery('alias', '');

		$newsModel = NewsChaska::model()->findByAttributes([
			'status' => NewsChaska::STATUS_SHOW,
			'alias' => $alias
		]);

		if (null === $newsModel) {
			throw new CHttpException(404);
		}

		$this->render(
			'view',
			[
				'newsModel' => $newsModel,
			]
		);
	}
}