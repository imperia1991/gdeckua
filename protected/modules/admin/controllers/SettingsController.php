<?php

class SettingsController extends AdminController
{
    public function init()
    {
        parent::init();

        $this->menuActive = 'settings';
    }
    public function actionIndex()
    {
        $settingsModel = Settings::model()->find();
        if (!$settingsModel) {
            $settingsModel = new Settings();
        }

        $this->processForm($settingsModel);
    }

    /** @var Settings $settingsModel */
    private function processForm($settingsModel)
    {
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Settings');

            /** @var Categories $settingsModel */
            $settingsModel->setAttributes($post);

            if ($settingsModel->save()) {
                Yii::app()->user->setFlash('success', 'Настройки сохранены');
            } else {
                Yii::app()->user->setFlash('error', 'Допущены ошибки при вводе настроек. Исправьте их.');
            }
        }

        $this->render('form', [
            'settingsModel' => $settingsModel,
        ]);
    }
}