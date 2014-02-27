<?php

class PartnerController extends AdminController
{
    public function init()
    {
        parent::init();

        $this->menuActive = 'partners';
        $this->pageTitle = Yii::app()->name . ' - Партнеры';
    }

    public function actionIndex()
    {
        $model = new Partners();

        if (Yii::app()->request->isAjaxRequest) {
            $params = Yii::app()->request->getParam('Partners');

            $model = new Partners('search');
            $model->attributes = $params;
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Partners();

        $this->processForm($model);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $model = Partners::model()->findByPk((int) $id);

        $this->processForm($model);
    }

    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            $model = Partners::model()->findByPk((int)$id);

            if (file_exists(Yii::app()->params['admin']['files']['partners'] . $model->logo_b)) {
                unlink(Yii::app()->params['admin']['files']['partners'] . $model->logo_b);
            }
            if (file_exists(Yii::app()->params['admin']['files']['partners'] . $model->logo_m)) {
                unlink(Yii::app()->params['admin']['files']['partners'] . $model->logo_m);
            }
            if (file_exists(Yii::app()->params['admin']['files']['partners'] . $model->logo_s)) {
                unlink(Yii::app()->params['admin']['files']['partners'] . $model->logo_s);
            }

            $model->delete();

            Yii::app()->user->setFlash('success', 'Партнер удален');

            Yii::app()->end();
        }
    }

    public function actionUpload() {
		if (isset(Yii::app()->session['image']) && file_exists(Yii::app()->params['admin']['files']['tmp'] . '/' . Yii::app()->session['image'])) {
			unlink(Yii::app()->params['admin']['files']['tmp'] . '/' . Yii::app()->session['image']);
		}

		Yii::import("ext.EAjaxUpload.qqFileUploader");

		$uploader = new qqFileUploader(Yii::app()->params['admin']['partners']['allowedExtensions'], Yii::app()->params['admin']['partners']['sizeLimit']);
		$result = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

        Yii::app()->session['image'] = $result['filename'];

		$this->respondJSON($result);
	}


    private function processForm($model)
    {
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Partners');
            $model->attributes = $post;

            $isNewRecord = $model->isNewRecord;
            if ($model->save()) {
                if ($model->logo) {
                    $photoPath = Yii::app()->params['admin']['files']['tmp'] . $model->logo;
                    $image = Yii::app()->image->load($photoPath);

                    $model->logo_b = $model->id . '_b' . '.' . $image->ext;
                    $image->save(Yii::app()->params['admin']['files']['partners'] . $model->logo_b);

                    $model->logo_m = $model->id . '_m' . '.' . $image->ext;
                    $image->resize(Yii::app()->params['admin']['partners']['middle']['width'], Yii::app()->params['admin']['partners']['middle']['height']);
                    $image->save(Yii::app()->params['admin']['files']['partners'] . $model->logo_m);

                    $model->logo_s = $model->id . '_s' . '.' . $image->ext;
                    $image->resize(Yii::app()->params['admin']['partners']['small']['width'], Yii::app()->params['admin']['partners']['small']['height']);
                    $image->save(Yii::app()->params['admin']['files']['partners'] . $model->logo_s);

                    $model->save(false);

                    if (file_exists($photoPath)){
                        unlink($photoPath);
                    }
                }

                Yii::app()->user->setFlash('success', $isNewRecord ? 'Партнер добавлен' : 'Данные о партнере изменены');

                $this->redirect($this->createUrl('/admin/partner'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }
}