<?php

/**
 * Class CommentsController
 */
class CommentsController extends Controller
{

    public function actionComments()
    {
        if (!Yii::app()->getRequest()->isAjaxRequest || !Yii::app()->getRequest()->isPostRequest) {
            $this->respondJSON(
                [
                    'error' => 1
                ]
            );
        }

        $this->processPageRequest('page');

        $placeId = Yii::app()->getRequest()->getPost('place_id');
        $comment = new Comments(Comments::SCENARIO_USER);

        /** @var CActiveDataProvider $dataProvider */
        $dataProvider = $comment->search($placeId);
//        echo '<pre>';
//        print_r(Yii::app()->getRequest()->getQuery('page', 0));
//        echo '</pre>';
        $this->renderPartial(
            '/partials/_commentsView',
            [
                'dataProvider' => $dataProvider,
                'model' => Places::model()->findByPk($placeId),
                'page' => Yii::app()->getRequest()->getQuery('page', 0)
            ]
        );

        Yii::app()->end();
    }

    public function actionCommentsNews()
    {
        if (!Yii::app()->getRequest()->isAjaxRequest || !Yii::app()->getRequest()->isPostRequest) {
            $this->respondJSON(
                [
                    'error' => 1
                ]
            );
        }

        $this->processPageRequest('page');

        $id = Yii::app()->getRequest()->getPost('id');
        $comment = new CommentsNews(CommentsNews::SCENARIO_USER);

        /** @var CActiveDataProvider $dataProvider */
        $dataProvider = $comment->search($id);
//        echo '<pre>';
//        print_r(Yii::app()->getRequest()->getQuery('page', 0));
//        echo '</pre>';
        $this->renderPartial(
            '/partials/_commentsView',
            [
                'dataProvider' => $dataProvider,
                'model' => News::model()->findByPk($id),
                'page' => Yii::app()->getRequest()->getQuery('page', 0)
            ]
        );

        Yii::app()->end();
    }

}