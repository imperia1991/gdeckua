<?php

class CommentsNewsController extends AdminController
{
    public function init()
    {
        parent::init();

        $this->menuActive = 'news';
    }
    public function actionIndex()
    {
        $model = new CommentsNews();

        $this->processForm($model);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $model = CommentsNews::model()->findByPk((int) $id);

        $this->processForm($model);
    }

    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            CommentsNews::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Комментарий удален');

            Yii::app()->end();
        }
    }

    private function processForm($model)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $get = Yii::app()->request->getQuery('CommentsNews');

            $model->setAttributes($get);

//            Yii::app()->end();
        }

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('CommentsNews');
            /** @var CommentsNews $model */
            $model->attributes = $post;
            $model->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', $model->created_at);

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Комментарий отредактирован');

                $this->redirect($this->createUrl('/admin/CommentsNews'));
            }
        }

        $this->render('index', [
            'model' => $model,
        ]);
    }
}