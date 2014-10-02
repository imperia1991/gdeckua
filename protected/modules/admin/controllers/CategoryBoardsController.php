<?php

/**
 * Class CategoryBoardsController
 */
class CategoryBoardsController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->menuActive = 'boards';

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     *
     */
    public function actionIndex()
    {
        $categoriesModel = new CategoryBoards();

        if (Yii::app()->request->isAjaxRequest) {
            $params = Yii::app()->request->getParam('CategoryBoards');

            $categoriesModel = new CategoryBoards('search');
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
        $categoryModel = new CategoryBoards();

        $this->processForm($categoryModel);
    }

    /**
     *
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $categoryModel = CategoryBoards::model()->findByPk((int)$id);

        $this->processForm($categoryModel);
    }

    /**
     *
     */
    public function actionDelete()
    {
        $id = Yii::app()->request->getQuery('id');

        CategoryBoards::model()->deleteByPk((int)$id);

        Yii::app()->user->setFlash('success', 'Категория удалена');

        $this->redirect(Yii::app()->createUrl('/admin/categoryBoards'));
    }

    /**
     * @param CategoryBoards $categoryModel
     */
    private function processForm($categoryModel)
    {
        /** @var CategoryBoards $categoryModel */
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('CategoryBoards');

            $isNewRecord = $categoryModel->isNewRecord;
            $transaction = $categoryModel->dbConnection->beginTransaction();

            try {
                /** @var CategoryNews $categoryModel */
                $categoryModel->setAttributes($post);
                if (!empty($post['parent_id'])) {
                    $categoryModel->parent_id = $post['parent_id'][0];
                }

                if ($categoryModel->title_ru) {
                    $categoryModel->alias = LocoTranslitFilter::cyrillicToLatin($categoryModel->title_ru);
                }

                if ($categoryModel->save()) {
                    $transaction->commit();

                    Yii::app()->user->setFlash(
                        'success',
                        $isNewRecord ? 'Категория добавлена' : 'Категория изменена'
                    );

                    $this->redirect($this->createUrl('/admin/categoryBoards'));
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