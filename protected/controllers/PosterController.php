<?php

/**
 * Class PosterController
 */
class PosterController extends Controller
{

    /**
     *
     */
    public function init()
    {
        parent::init();

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return [
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => [
                'class' => 'CCaptchaAction',
                'backColor' => 0x494949,
                'foreColor' => 0xFFFFFF
            ],
        ];
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->currentPageType = PageTypes::PAGE_POSTERS;

        $currentCategoryAlias = Yii::app()->getRequest()->getQuery('alias', '');
        /** @var CategoryPosters $currentCategory */
        if ($currentCategoryAlias) {
            $currentCategory = CategoryPosters::model()->find('alias = "' . $currentCategoryAlias . '"');
        } else {
            $currentCategory = CategoryPosters::model()->find('is_affisha = 1');
        }

        $posters = Posters::model()->getPosters($currentCategory->id);
        $categories = CategoryPosters::model()->getAll();

        if (Yii::app()->getRequest()->isAjaxRequest) {
            $this->processPageRequest('page');

            if ($currentCategory->is_affisha) {
                $this->renderPartial(
                    '/poster/partials/_affishesItems',
                    [
                        'posters' => $posters,
                        'currentCategory' => $currentCategory,
                        'page' => Yii::app()->getRequest()->getQuery('page', 0)
                    ]
                );
            } else {
                $this->renderPartial(
                    '/poster/partials/_otherItems',
                    [
                        'posters' => $posters,
                        'currentCategory' => $currentCategory,
                        'page' => Yii::app()->getRequest()->getQuery('page', 0)
                    ]
                );
            }


            Yii::app()->end();
        }

        $this->render(
            'index',
            [
                'posters' => $posters,
                'categories' => $categories,
                'currentCategory' => $currentCategory,
            ]
        );
    }
}