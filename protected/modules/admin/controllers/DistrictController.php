<?php

class DistrictController extends AdminController
{

    public function init()
    {
        parent::init();

        $this->menuActive = 'district';
        $this->pageTitle = Yii::app()->name . ' - Районы';
    }

    public function actionIndex()
    {
        $model = new Districts();

        if (Yii::app()->request->isAjaxRequest) {
            $params = Yii::app()->request->getParam('Districts');

            $model = new Districts('search');
            $model->attributes = $params;
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Districts();

        $this->processForm($model);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $model = Districts::model()->findByPk((int) $id);

        $this->processForm($model);
    }

    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            $model = Districts::model()->findByPk((int) $id);

            $model->delete();

            Yii::app()->user->setFlash('success', 'Район удален');

            Yii::app()->end();
        }
    }

    private function processForm($model)
    {
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Districts');

            $model->setAttributes($post);

            $isNewRecord = $model->isNewRecord;
            if ($model->save()) {
                Yii::app()->user->setFlash('success', $isNewRecord ? 'Район добавлен' : 'Данные о районе изменены');

                $this->redirect(Yii::app()->createUrl('/admin/district'));
            } else {
                Yii::app()->user->setFlash('error', 'Ошибка при добавлении данных');
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

}