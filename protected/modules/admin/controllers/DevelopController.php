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
        $this->render('index', []);
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

	public function actionCorrectImages()
	{
		/** @var Photos[] $placesPhotos */
		$placesPhotos = Photos::model()->findAll();
		$photoPath = Yii::app()->params['admin']['files']['images'];
		$directoryB = Yii::app()->params['admin']['files']['imagesB'];
		$directoryS = Yii::app()->params['admin']['files']['imagesS'];

		foreach ($placesPhotos as $photo) {
			if (!file_exists($photoPath . $photo->title)) {
				continue;
			}

			$image = new EasyImage($photoPath . $photo->title);
			$image->resize(800, 600, EasyImage::RESIZE_PRECISE);
			$image->save($directoryB . $photo->title);

			unset($image);

			$image = new EasyImage($photoPath . $photo->title);
			$image->resize(220, 150, EasyImage::RESIZE_PRECISE);
			$image->save($directoryS . $photo->title);

			unset($image);
		}

		$this->redirect(Yii::app()->createUrl('/admin/develop'));
	}
}