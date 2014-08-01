<?php

class CommentsController extends Controller
{

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionComments()
    {
        if (!Yii::app()->getRequest()->isAjaxRequest || !Yii::app()->getRequest()->isPostRequest) {
            $this->respondJSON([
                    'error' => 1
                ]);
        }

        $this->processPageRequest('page');

        $placeId = Yii::app()->getRequest()->getPost('place_id');
        $comment = new Comments(Comments::SCENARIO_USER);

        $this->renderPartial('/site/partials/_commentsView', [
               'dataProvider' => $comment->search($placeId),
               'model' => Places::model()->findByPk($placeId),
            ]);

        Yii::app()->end();

//        $this->respondJSON([
//                'error' => 0,
//                'commentsView' => $this->renderPartial('/site/partials/_commentsView', [
//                            $comment->search($placeId),
//                        ]),
//            ]);
    }

}