<?php

class SettingsController extends AdminController
{
    public function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        $this->menuActive = 'settings';

        $model = Contacts::model()->find();
        $oldPassword = $model->password;

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Contacts');

            $model->attributes = $post;
            $model->password = $post['password'] ? md5($post['password']) : $oldPassword;


            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Настройки сохранены');
            }
            else {
                Yii::app()->user->setFlash('error', 'Вы допустили ошибки при сохранении настроек. Исправьте.');
            }
        }

        $this->render('index', array('model' => $model));
    }

    public function actionPayment()
    {
        $this->menuActive = 'payment';

        $model = Contacts::model()->find();

        if (Yii::app()->request->isPostRequest) {
            $payment = Yii::app()->request->getPost('payment');

            $model->payment = $payment;

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Информация о Доставке и оплате сохранена');
            }
            else {

                Yii::app()->user->setFlash('error', 'Информация о Доставке и оплате не сохранена');
            }
        }

        $this->render('payment', array('model' => $model));
    }

    public function actionAbout()
    {
        $this->menuActive = 'about';

        $model = Contacts::model()->find();

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Contacts');

            $model->about_us = nl2br($post['about_us']);

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Информация О Нас сохранена');
            }
            else {

                Yii::app()->user->setFlash('error', 'Информация О Нас не сохранена');
            }
        }

        $this->render('about', array('model' => $model));
    }

}