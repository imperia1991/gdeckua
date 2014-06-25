<?php

class CommentsController extends AdminController
{
    public function init()
    {
        parent::init();

        $this->menuActive = 'comments';
    }
    public function actionIndex()
    {
        $model = new Comments();

        $this->processForm($model);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $model = Comments::model()->findByPk((int) $id);

        $this->processForm($model);
    }

    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            Comments::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Комментарий удален');

            Yii::app()->end();
        }
    }

    private function processForm($model)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $get = Yii::app()->request->getQuery('Comments');

            $model->setAttributes($get);

//            Yii::app()->end();
        }

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Comments');
            /** @var Comments $model */
            $model->attributes = $post;
            $model->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', $model->created_at);

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Комментарий отредактирован');

                $this->redirect($this->createUrl('/admin/comments'));
            }
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }
}