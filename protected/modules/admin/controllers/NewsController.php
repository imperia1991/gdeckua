<?php

class NewsController extends AdminController
{
    public function init()
    {
        parent::init();

        $this->menuActive = 'news';

        Yii::import('application.extensions.LocoTranslitFilter');
    }
    public function actionIndex()
    {
        $newsModel = new News();
        $categoriesModel = new CategoryNews();

        $this->render('index', array(
                'newsModel' => $newsModel,
                'categoriesModel' => $categoriesModel,
            ));
    }

    public function actionCategories()
    {
        $categoriesModel = new Categories();

        $this->render('indexCategories', array(
                'categoriesModel' => $categoriesModel,
            ));
    }

    public function actionCreateCategory()
    {
        $categoryModel = new CategoryNews();

        $this->processFormCategory($categoryModel);    }

    public function actionUpdateCategory()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $categoryModel = CategoryNews::model()->findByPk((int) $id);

        $this->processFormCategory($categoryModel);
    }

    public function actionDeleteCategory()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            CategoryNews::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Категория удалена');

            Yii::app()->end();
        }
    }

    private function processFormCategory($categoryModel)
    {
        /** @car CategoryNews $categoryModel */
        if (Yii::app()->request->isAjaxRequest) {
            $get = Yii::app()->request->getQuery('CategoryNews');

            $categoryModel->setAttributes($get);
        }

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('CategoryNews');

            /** @var Categories $model */
            $categoryModel->setAttributes($post);

            $isNewRecord = $categoryModel->isNewRecord;
            if ($categoryModel->save()) {
                Yii::app()->user->setFlash('success', $isNewRecord ? 'Категория добавлена' : 'Название категории изменено');

                $this->redirect($this->createUrl('/admin/categories'));
            }
        }

        $this->render('categoryForm', array(
            'categoryModel' => $categoryModel,
        ));
    }
}