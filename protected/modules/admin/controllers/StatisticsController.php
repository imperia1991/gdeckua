<?php

class StatisticsController extends AdminController
{

    public function init()
    {
        parent::init();

        $this->menuActive = 'statistic';
        $this->pageTitle = Yii::app()->name . ' - Статистика';
    }

    public function actionIndex()
    {
        $model = new WordStatistics();

        if (Yii::app()->request->isAjaxRequest) {
            $get = Yii::app()->request->getQuery('WordStatistics');
            $model->setAttributes($get);
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionWords()
    {
        $model = new WordStatistics();

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