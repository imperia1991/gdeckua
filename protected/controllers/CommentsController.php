<?php

/**
 * Class CommentsController
 */
class CommentsController extends Controller
{

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
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
            '/site/partials/_commentsView',
            [
                'dataProvider' => $dataProvider,
                'model' => Places::model()->findByPk($placeId),
                'page' => Yii::app()->getRequest()->getQuery('page', 0)
            ]
        );

        Yii::app()->end();

//        $this->respondJSON([
//                'error' => 0,
//                'commentsView' => $this->renderPartial('/site/partials/_commentsView', [
//                            $comment->search($placeId),
//                        ]),
//            ]);
    }

}