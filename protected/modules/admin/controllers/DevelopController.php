<?php

class DevelopController extends AdminController
{
    public function init()
    {
        parent::init();

        $this->menuActive = 'develop';

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    public function actionIndex()
    {
        $this->render('index', array());
    }

    public function actionMakeAlias()
    {
        $placesModel = new Places();
        $places = $placesModel->findAll();

        $transaction = Yii::app()->db->beginTransaction();
        try {
            /** @var Places $place */
            foreach ($places as $place) {
                $place->alias = LocoTranslitFilter::cyrillicToLatin($place->title_ru);

                $place->save(false);
            }

            $transaction->commit();

            Yii::app()->user->setFlash('success', Yii::t('main', 'Алиасы созданы'));
        } catch (Exception $e) {
            Yii::app()->user->setFlash('error', Yii::t('main', 'Создание алиасов завершилось с ошибкой: ' . $e->getMessage()));

            $transaction->rollback();
        }

        $this->redirect(Yii::app()->createUrl('/admin/develop'));
    }

    public function actionUpdateTags()
    {
        $tags = PlaceTags::model()->findAll();

        $transaction = Yii::app()->db->beginTransaction();
        try {
            /** @var PlaceTags $tag */
            foreach ($tags as $tag) {
                $tag->tags = str_replace(',', ', ', $tag->tags);
                $tag->save(false);
            }

            $transaction->commit();

            Yii::app()->user->setFlash('success', Yii::t('main', 'Теги обновлены'));
        } catch (Exception $e) {
            Yii::app()->user->setFlash('error', Yii::t('main', 'Обновление тегов с ошибкой: ' . $e->getMessage()));

            $transaction->rollback();
        }

        $this->redirect(Yii::app()->createUrl('/admin/develop'));
    }
}