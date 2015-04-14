<?php

/**
 * Class CategoryBlogController
 */
class CategoryBlogController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->menuActive = 'blog';

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     *
     */
    public function actionIndex()
    {
        $categoriesModel = new CategoryBlog();

        if (Yii::app()->request->isAjaxRequest) {
            $params = Yii::app()->request->getParam('CategoryBlog');

            $categoriesModel = new CategoryBlog('search');
            $categoriesModel->setAttributes($params);
        }

        $this->render(
            'index',
            [
                'categoriesModel' => $categoriesModel,
            ]
        );
    }

    /**
     *
     */
    public function actionCreate()
    {
        $categoryModel = new CategoryBlog();

        $this->processForm($categoryModel);
    }

    /**
     *
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $categoryModel = CategoryBlog::model()->findByPk((int)$id);

        $this->processForm($categoryModel);
    }

    /**
     *
     */
    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            CategoryBlog::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Категория удалена');

            Yii::app()->end();
        }
    }

    /**
     * @param $categoryModel
     */
    private function processForm($categoryModel)
    {
        /** @var CategoryBlog $categoryModel */
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('CategoryBlog');

            $isNewRecord = $categoryModel->isNewRecord;
            $transaction = $categoryModel->dbConnection->beginTransaction();

            try {
                /** @var CategoryBlog $categoryModel */
                $categoryModel->setAttributes($post);
                if ($categoryModel->title_ru) {
	                if (empty($categoryModel->alias)) {
		                $categoryModel->alias = LocoTranslitFilter::cyrillicToLatin($categoryModel->title_ru);
	                }
                }

                if ($categoryModel->save()) {
                    $transaction->commit();

                    Yii::app()->user->setFlash(
                        'success',
                        $isNewRecord ? 'Категория добавлена' : 'Категория изменена'
                    );

                    $this->redirect($this->createUrl('/admin/categoryBlog'));
                } else {
                    Yii::app()->user->setFlash('error', 'Ошибка при добалении категории');

                    $transaction->rollback();
                }
            } catch (Exception $e) {
	            echo '<pre>';
	            print_r($e->getMessage());
	            echo '</pre>';
                Yii::app()->user->setFlash('error', 'Ошибка на сервере при добалении категории. Попробуйте позже.');

                $transaction->rollback();
            }
        }

        $this->render(
            'form',
            [
                'categoryModel' => $categoryModel,
            ]
        );
    }
}