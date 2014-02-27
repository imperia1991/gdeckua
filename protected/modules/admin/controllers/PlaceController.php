<?php

class PlaceController extends AdminController
{
    public function init()
    {
        parent::init();

        $this->menuActive = 'place';
        $this->pageTitle = Yii::app()->name . ' - Места';
    }

    public function actionIndex()
    {
        $model = new Places();

        if (Yii::app()->request->isAjaxRequest) {
            $params = Yii::app()->request->getParam('Places');

            $model = new Places('search');
            $model->attributes = $params;
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Places();

        $this->processForm($model);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $model = Places::model()->findByPk((int) $id);

        $this->processForm($model);
    }

    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            $model = Places::model()->findByPk((int)$id);

            if (file_exists(Yii::app()->params['admin']['files']['images'] . $model->photo_b)) {
                unlink(Yii::app()->params['admin']['files']['images'] . $model->photo_b);
            }
            if (file_exists(Yii::app()->params['admin']['files']['images'] . $model->photo_m)) {
                unlink(Yii::app()->params['admin']['files']['images'] . $model->photo_m);
            }
            if (file_exists(Yii::app()->params['admin']['files']['images'] . $model->photo_s)) {
                unlink(Yii::app()->params['admin']['files']['images'] . $model->photo_s);
            }

            $model->delete();

            Yii::app()->user->setFlash('success', 'Мебель удалена');

            Yii::app()->end();
        }
    }

    public function actionUpload() {
//		if (isset(Yii::app()->session['image']) && file_exists(Yii::app()->params['admin']['files']['tmp'] . '/' . Yii::app()->session['image'])) {
//			unlink(Yii::app()->params['admin']['files']['tmp'] . '/' . Yii::app()->session['image']);
//		}

		Yii::import("ext.EAjaxUpload.qqFileUploader");

		$uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app()->params['admin']['images']['sizeLimit']);
		$result = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

        Yii::app()->session['images'][] = $result['filename'];

		$this->respondJSON($result);
	}

	public function actionDeletePreviewUpload()
	{
        $request = Yii::app()->request;

		if (!$request->isAjaxRequest || !$request->isPostRequest) {
            Yii::app()->end();
        }

        $filename = $request->getPost('filename', '');

		$result = false;
		if ($filename && file_exists(Yii::app()->params['admin']['files']['tmp'] . $filename))
		{
			$result = unlink(Yii::app()->params['admin']['files']['tmp'] . $filename);
		}

		$this->respondJSON($result);

		Yii::app()->end();
	}

	public function actionDeletePhoto()
	{
		$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

		$model = Photos::model()->findByPk($id);

		$this->respondJSON($model ? $model->delete() : false);

		Yii::app()->end();
	}

    private function processForm($model)
    {
        if (Yii::app()->request->isPostRequest) {
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';exit;
            $postPlace = Yii::app()->request->getPost('Places');
            $postPlacetags = Yii::app()->request->getPost('PlaceTags');
            $model->attributes = $post;

            $isNewRecord = $model->isNewRecord;
            if ($model->save()) {
                $photoPath = Yii::app()->params['admin']['files']['tmp'] . $model->photo;
                $image = Yii::app()->image->load($photoPath);

                $model->photo_b = $model->id . '_b' . '.' . $image->ext;
				$image->save(Yii::app()->params['admin']['files']['images'] . $model->photo_b);

                $model->photo_m = $model->id . '_m' . '.' . $image->ext;
				$image->resize(Yii::app()->params['admin']['images']['middle']['width'], Yii::app()->params['admin']['images']['middle']['height']);
				$image->save(Yii::app()->params['admin']['files']['images'] . $model->photo_m);

                $model->photo_s = $model->id . '_s' . '.' . $image->ext;
				$image->resize(Yii::app()->params['admin']['images']['small']['width'], Yii::app()->params['admin']['images']['small']['height']);
				$image->save(Yii::app()->params['admin']['files']['images'] . $model->photo_s);

                $model->save(false);

                if (file_exists($photoPath)){
                    unlink($photoPath);
                }

                Yii::app()->user->setFlash('success', $isNewRecord ? 'Мебель добавлена' : 'Данные о мебели изменены');

                $this->redirect($this->createUrl('/admin/furniture'));
            }
        }

        $categories = CHtml::listData(Categories::model()->findAll(), 'id', 'title');

        $this->render('create', array(
            'model' => $model,
            'categories' => $categories
        ));
    }
}