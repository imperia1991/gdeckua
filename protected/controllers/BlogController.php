<?php

/**
 * Class BlogController
 */
class BlogController extends Controller
{

    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->currentPageType = PageTypes::PAGE_NEWS;

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
        $rss = RssContent::model()->getAll();

        if (Yii::app()->request->isAjaxRequest) {
            $this->processPageRequest('page');

            $this->respondJSON(
                [
                    'newsView' => $this->renderPartial(
                        '/news/partials/_newsView',
                        [
                            'news' => $news,
                            'page' => Yii::app()->getRequest()->getQuery('page', 0)
                        ], true
                    ),
                    'rssView' => $this->renderPartial(
                        '/news/partials/_rssView',
                        [
                            'rss' => $rss,
                            'page' => Yii::app()->getRequest()->getQuery('page', 0)
                        ], true
                    )
                ]
            );
        }

        $categories = CategoryNews::model()->findAll();

        $this->render(
            'index',
            [
                'news' => $news,
                'rss' => $rss,
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