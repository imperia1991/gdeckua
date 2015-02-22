<?php

/**
 * Class PlaceController
 */
class PlaceController extends Controller
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->currentPageType = PageTypes::PAGE_PLACES;

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->modelPlaces = new Places();
        $this->modelPlaces->search = Yii::app()->request->getQuery('search', '');
        $this->modelPlaces->district_id = (int) Yii::app()->request->getQuery('districts', '');

        if ($this->modelPlaces->search || $this->modelPlaces->district_id) {
            if ($this->modelPlaces->search) {
                $statistics = new WordStatistics();
                $statistics->words = $this->modelPlaces->search;
                $statistics->save();
                unset($statistics);
            }

            $controller = Yii::app()->createController('/search');
            $results = $controller[0]->search($this->modelPlaces->search, $this->modelPlaces->district_id);

            $dataProvider = Places::model()->getByIds($results);
            $items = $dataProvider['items'];
            $pages = $dataProvider['pages'];
        } else {
            $isFirst = Yii::app()->request->getQuery('page', 0) ? false : true;
            $dataProvider = $this->modelPlaces->searchMain($isFirst);
            $items = $dataProvider->getData();
            $pages = $dataProvider->getPagination();
        }

        $this->currentPage = $pages->currentPage;

        $this->checkedString = $this->checkedSearchString($this->modelPlaces->search);
//        $this->checkedString = '';

        $this->render(
            'index', [
                'model' => $this->modelPlaces,
                'items' => $items,
                'pages' => $pages,
            ]
        );
    }

    /**
     * Проверка правописания при поиске
     * @param $search
     * @return mixed|string
     */
    private function checkedSearchString($search)
    {
        $checker = json_decode(
            file_get_contents(
                "http://speller.yandex.net/services/spellservice.json/checkText?text=" . urlencode($search) . '&lang=en,' . Yii::app()->getLanguage()
            )
        );
        $checkedStr = $search;
        foreach ($checker as $word) {
            if (isset($word->s[0])) {
                $checkedStr = str_replace($word->word, $word->s[0], $checkedStr);
            }
        }

        return mb_strtolower($checkedStr, 'utf8') != mb_strtolower($search, 'utf8') && !empty($checkedStr)
            ? $checkedStr
            : '';
    }

    /**
     * Просмотр объекта
     *
     * @throws CHttpException
     */
    public function actionView()
    {
        $this->currentPageType = PageTypes::PAGE_PLACE_VIEW;

        $id = Yii::app()->request->getQuery('id', 0);
        $model = Places::model()->findByPk((int)$id);
        $comment = new Comments(Comments::SCENARIO_USER);

        if (!is_object($model)) {
            throw new CHttpException(404, Yii::t('main', 'Такой объект не найден'));
        }

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Comments', array());

            $comment->setAttributes($post);
            $comment->message = nl2br($comment->message);
            $comment->place_id = $model->id;
            $comment->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());

            if ($comment->save()) {
                Yii::app()->user->setFlash('success', Yii::t('main', 'Спасибо. Ваш комментарий добавлен'));

                $comment = new Comments(Comments::SCENARIO_USER);
            } else {
                Yii::app()->user->setFlash('error', Yii::t('main', 'Вы допустили ошибки при добавлении комментария'));
            }
        }

        $criteria = new CDbCriteria();
        $criteria->order = 'title_' . Yii::app()->getLanguage() . ' ASC';
        $districts = CHtml::listData(
            Districts::model()->findAllByAttributes([], $criteria),
            'id',
            'title_' . Yii::app()->getLanguage()
        );

        $this->render(
            'view',
            [
                'model' => $model,
                'comment' => $comment,
                'districts' => $districts,
            ]
        );
    }

    /**
     * Добавление объекта
     */
    public function actionAdd()
    {
        $model = new Places(Yii::app()->getLanguage());
        $modelContacts = new Contacts();

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Places', []);
            $postPhotos = Yii::app()->request->getPost('Photos', []);
            $postContacts = Yii::app()->request->getPost('Contacts', []);

            $transaction = $model->dbConnection->beginTransaction();
            try {
                $model->setAttributes($post);
                $model->images = $postPhotos;
                $model->is_deleted = 1;
                $model->alias = LocoTranslitFilter::cyrillicToLatin($model->title_ru);
                $model->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());

                $modelContacts->setAttributes($postContacts);

                if ($model->save()) {
                    if ($postPhotos) {
                        $photoQuery = [];
                        foreach ($postPhotos as $photo) {
                            $photoQuery[] = '(' . $model->id . ', "' . $photo . '")';
                        }

                        $photoQueries = join(',', $photoQuery);
                        Yii::app()->db->createCommand(
                            'INSERT INTO photos (place_id, title) VALUES ' . $photoQueries
                        )
                            ->execute();
                    }

                    $modelContacts->place_id = $model->id;

                    if (!$modelContacts->save()) {
                        $model->addErrors($modelContacts->getErrors());

                        Yii::app()->user->setFlash('error', Yii::t('main', 'Вы допустили ошибки при добавлении места'));

                        $transaction->rollback();
                    } else {
                        $transaction->commit();

                        if ($postPhotos) {
                            foreach ($postPhotos as $photo) {
                                $photoPath = Yii::app()->params['admin']['files']['tmp'] . $photo;

	                            $image = new EasyImage($photoPath);
	                            $image->resize(800, 600, EasyImage::RESIZE_PRECISE);
	                            $image->save(Yii::app()->params['admin']['files']['imagesB']  . $photo);

	                            unset($image);

	                            $image = new EasyImage($photoPath);
	                            $image->resize(220, 150,  EasyImage::RESIZE_PRECISE);
	                            $image->save(Yii::app()->params['admin']['files']['imagesS']  . $photo);

                                if (file_exists($photoPath)) {
                                    unlink($photoPath);
                                }
                            }

                            unset(Yii::app()->session['images']);
                            unset(Yii::app()->session['countImages']);
                        }

                        Yii::app()->user->setFlash(
                            'success',
                            Yii::t('main', 'Спасибо. Ваш объект добавлен. После модерации он появится в поиске')
                        );

                        $this->redirect(Yii::app()->createUrl(Yii::app()->getLanguage() . '/place'));
                    }
                } else {
                    if (!$modelContacts->validate()) {
                        $model->addErrors($modelContacts->getErrors());

                    }
                    Yii::app()->user->setFlash('error', Yii::t('main', 'Вы допустили ошибки при добавлении места'));
                }
            } catch (Exception $e) {
                $transaction->rollback();
            }
        }

        $title = 'title_' . Yii::app()->getLanguage();

        $districts = CHtml::listData(Districts::model()->findAll(['order' => $title]), 'id', $title);
        $districts[-1] = Yii::t('main', 'Не указан');

        $this->render(
            'place',
            [
                'model' => $model,
                'modelContacts' => $modelContacts,
                'districts' => $districts
            ]
        );
    }

    /**
     * Загрузка изображений во временную папку
     */
    public function actionUpload()
    {
        $countImages = isset(Yii::app()->session['countImages']) ? Yii::app()->session['countImages'] : 0;

        if ($countImages > 2) {
            $this->respondJSON(array('success' => false));
        } else {
            $countImages++;
            Yii::app()->session['countImages'] = $countImages;
        }

        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app()->params['admin']['images']['sizeLimit']);
        $result = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

        $sessionImages = Yii::app()->session['images'];
        $sessionImages[] = $result['filename'];
        Yii::app()->session['images'] = $sessionImages;

        $this->respondJSON($result);
    }

    /**
     * Удалени предпросмотра изображений
     */
    public function actionDeletePreviewUpload()
    {
        $request = Yii::app()->request;

        if (!$request->isAjaxRequest || !$request->isPostRequest) {
            Yii::app()->end();
        }

        $filename = $request->getPost('filename', '');

        $result = false;
        if ($filename && file_exists(Yii::app()->params['admin']['files']['tmp'] . $filename)) {
            $result = unlink(Yii::app()->params['admin']['files']['tmp'] . $filename);

            if (isset(Yii::app()->session['countImages'])) {
                $countImages = Yii::app()->session['countImages'];
                Yii::app()->session['countImages'] = $countImages - 1;
            }

            $imagesOld = $images = Yii::app()->session['images'];
            foreach ($images as $key => $image) {
                if ($filename == $image) {
                    unset($imagesOld[$key]);

                    break;
                }
            }

            Yii::app()->session['images'] = $imagesOld;
        }

        $this->respondJSON($result);

        Yii::app()->end();
    }

}