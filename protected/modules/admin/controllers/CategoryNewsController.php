<?php

/**
 * Class CategoryNewsController
 */
class CategoryNewsController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->menuActive = 'news';

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     *
     */
    public function actionIndex()
    {
        $categoriesModel = new CategoryNews();

        if (Yii::app()->request->isAjaxRequest) {
            $params = Yii::app()->request->getParam('CategoryNews');

            $categoriesModel = new CategoryNews('search');
            $categoriesModel->setAttributes($params);
        }

        $this->render(
            'index',
            array(
                'categoriesModel' => $categoriesModel,
            )
        );
    }

    /**
     *
     */
    public function actionCreate()
    {
        $categoryModel = new CategoryNews();

        $this->processForm($categoryModel);
    }

    /**
     *
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $categoryModel = CategoryNews::model()->findByPk((int)$id);

        $this->processForm($categoryModel);
    }

    /**
     *
     */
    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            CategoryNews::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Категория удалена');

            Yii::app()->end();
        }
    }

    /**
     * @param $categoryModel
     */
    private function processForm($categoryModel)
    {
        /** @var CategoryNews $categoryModel */
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('CategoryNews');

            $isNewRecord = $categoryModel->isNewRecord;
            $transaction = $categoryModel->dbConnection->beginTransaction();

            try {
                /** @var CategoryNews $categoryModel */
                $categoryModel->setAttributes($post);
                if ($categoryModel->title_ru) {
                    $categoryModel->aliases = LocoTranslitFilter::cyrillicToLatin($categoryModel->title_ru);
                }

                if ($categoryModel->save()) {
                    $transaction->commit();

                    Yii::app()->user->setFlash(
                        'success',
                        $isNewRecord ? 'Категория добавлена' : 'Категория изменена'
                    );

                    $this->redirect($this->createUrl('/admin/categoryNews'));
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
            array(
                'categoryModel' => $categoryModel,
            )
        );
    }
}