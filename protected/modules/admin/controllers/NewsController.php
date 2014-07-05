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

        if (Yii::app()->request->isAjaxRequest) {
            $get = Yii::app()->request->getQuery('News');

            $newsModel->setAttributes($get);
        }

        $this->render('index', array(
                'newsModel' => $newsModel,
                'categoriesModel' => $categoriesModel,
            ));
    }

    public function actionCreate()
    {
        $newsModel = new News();

        $this->processForm($newsModel);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $newsModel = News::model()->findByPk((int) $id);

        $this->processForm($newsModel);
    }

    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            News::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Новость удалена');

            Yii::app()->end();
        }
    }

    /** @var News $newsModel */
    private function processForm($newsModel)
    {
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('News');

            $newsModel->setAttributes($post);

            $isNewRecord = $newsModel->isNewRecord;
            if ($newsModel->save()) {
                Yii::app()->user->setFlash('success', $isNewRecord ? 'Новость добавлена' : 'Новость изменена');

                $this->redirect($this->createUrl('/admin/news'));
            } else {
                Yii::app()->user->setFlash('error', 'Допущены ошибки при вводе новости. Исправьте их.');
            }
        }

        $categories = CHtml::listData(CategoryNews::model()->findAll(array('order' => 'title_ru')), 'id', 'title_ru');

        $this->render('form', array(
            'newsModel' => $newsModel,
            'categories' => $categories,
        ));
    }
}