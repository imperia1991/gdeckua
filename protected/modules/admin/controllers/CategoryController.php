<?php

class CategoryController extends AdminController
{
    public function init()
    {
        parent::init();

        $this->menuActive = 'category';
    }
    public function actionIndex()
    {
        $model = new Categories();

        $this->processForm($model);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $model = Categories::model()->findByPk((int) $id);

        $this->processForm($model);
    }

    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            Categories::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Категория удалена');

            Yii::app()->end();
        }
    }

    private function processForm($model)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $get = Yii::app()->request->getQuery('Categories');

            $model->setAttributes($get);

//            Yii::app()->end();
        }

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Categories');
            $model->attributes = $post;

            $isNewRecord = $model->isNewRecord;
            if ($model->save()) {
                Yii::app()->user->setFlash('success', $isNewRecord ? 'Категория добавлена' : 'Название категории изменено');

                $this->redirect($this->createUrl('/admin/category'));
            }
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }
}