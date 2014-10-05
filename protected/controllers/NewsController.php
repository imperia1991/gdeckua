<?php

/**
 * Class NewsController
 */
class NewsController extends Controller
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
        $this->currentPageType = PageTypes::PAGE_NEWS;

        $category = Yii::app()->getRequest()->getQuery('alias', '');

//        $categoryModel = CategoryNews::model()->findByAttributes(['aliases' => $category]);
//        if (!is_object($category)) {
//            throw new CHttpException(404, '');
//        }

        $isOpinion = $category == News::OPINION ? News::IS_OPINION : News::IS_NOT_OPINION;
        $news = News::model()->getAll($isOpinion, $category);

        if (Yii::app()->request->isAjaxRequest) {
            $this->processPageRequest('page');

            $this->renderPartial(
                '/news/partials/_newsView',
                [
                    'news' => $news,
                    'page' => Yii::app()->getRequest()->getQuery('page', 0)
                ]
            );

            Yii::app()->end();
        }

        $previewComments = CommentsNews::model()->getPreviewComments();
        $previewOpinions = News::model()->getPreviewNews(News::IS_OPINION, 3);
        $categories = CategoryNews::model()->findAll();

        $this->render(
            'index',
            [
                'news' => $news,
                'previewComments' => $previewComments,
                'previewOpinions' => $previewOpinions,
                'categories' => $categories,
                'currentCategory' => $category,
            ]
        );
    }

    /**
     * @throws CHttpException
     */
    public function actionView()
    {
        $this->currentPageType = PageTypes::PAGE_ONE_NEWS_VIEW;

        $id = Yii::app()->request->getQuery('id', 0);

        if (null === News::model()->findByPk($id)) {
            throw new CHttpException(404);
        }

        /** @var News[] $newsModels  */
        $newsModels = News::model()->getViewNews($id);

        $comment = new CommentsNews(CommentsNews::SCENARIO_USER);

        if (!is_array($newsModels)) {
            throw new CHttpException(404, Yii::t('main', 'Такая новость не найдена'));
        }

        /** @var News $prevNewsModel */
        $prevNewsModel = null;
        /** @var News $currentNewsModel */
        $currentNewsModel = null;
        /** @var News $nextNewsModel */
        $nextNewsModel = null;


        if (count($newsModels) == 3) {
            $prevNewsModel = $newsModels[2];
            $currentNewsModel = $newsModels[1];
            $nextNewsModel = $newsModels[0];
        } elseif (count($newsModels) == 2) {
            if ($id == $newsModels[1]->id) {
                $prevNewsModel = null;
                $currentNewsModel = $newsModels[1];
                $nextNewsModel = $newsModels[0];
            } else {
                $prevNewsModel = $newsModels[1];
                $currentNewsModel = $newsModels[0];
                $newsModels = null;
            }
        } elseif (count($newsModels == 1)) {
            $prevNewsModel = null;
            $currentNewsModel = $newsModels[0];
            $nextNewsModel = null;
        }

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('CommentsNews', []);

            $comment->setAttributes($post);
            $comment->message = nl2br($comment->message);
            $comment->news_id = $currentNewsModel->id;
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
                'prevNewsModel' => $prevNewsModel,
                'currentNewsModel' => $currentNewsModel,
                'nextNewsModel' => $nextNewsModel,
                'comment' => $comment
            ]
        );
    }

}