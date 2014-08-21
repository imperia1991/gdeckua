<?php

/**
 * Class CategoryPosterController
 */
class CategoryPosterController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->menuActive = 'poster';

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     *
     */
    public function actionIndex()
    {
        $categoriesModel = new CategoryPosters();

        if (Yii::app()->request->isAjaxRequest) {
            $params = Yii::app()->request->getParam('CategoryPosters');

            $categoriesModel = new CategoryPosters('search');
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
        $categoryModel = new CategoryPosters();

        $this->processForm($categoryModel);
    }

    /**
     *
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $categoryModel = CategoryPosters::model()->findByPk((int)$id);

        $this->processForm($categoryModel);
    }

    /**
     *
     */
    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            CategoryPosters::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Категория удалена');

            Yii::app()->end();
        }
    }

    /**
     * @param CategoryPosters $categoryModel
     */
    private function processForm($categoryModel)
    {
        /** @var CategoryPosters $categoryModel */
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('CategoryPosters');

            $isNewRecord = $categoryModel->isNewRecord;
            $transaction = $categoryModel->dbConnection->beginTransaction();

            try {
                $categoryModel->setAttributes($post);
                if ($categoryModel->title_ru) {
                    $categoryModel->alias = LocoTranslitFilter::cyrillicToLatin($categoryModel->title_ru);
                }

                if ($categoryModel->save()) {
                    $transaction->commit();

                    Yii::app()->user->setFlash(
                        'success',
                        $isNewRecord ? 'Категория добавлена' : 'Категория изменена'
                    );

                    $this->redirect($this->createUrl('/admin/categoryPoster'));
                } else {
                    Yii::app()->user->setFlash('error', 'Ошибка при добалении категории');

                    $transaction->rollback();
                }
            } catch (Exception $e) {
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