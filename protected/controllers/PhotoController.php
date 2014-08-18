<?php

/**
 * Class PhotoController
 */
class PhotoController extends Controller
{

    /**
     *
     */
    public function init()
    {
        parent::init();

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return [
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => [
                'class' => 'CCaptchaAction',
                'backColor' => 0x494949,
                'foreColor' => 0xFFFFFF
            ],
        ];
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $photos = PhotoCity::model()->getAll();

        $this->render(
            'index',
            [
                'photos' => $photos
            ]
        );
    }

    /**
     *
     */
    public function actionAdd()
    {
        $photoCityModel = new PhotoCity(PhotoCity::SCENARIO_USER);

        if (Yii::app()->getRequest()->isPostRequest) {
            $post = Yii::app()->getRequest()->getPost('PhotoCity', []);
            $photoCityModel->setAttributes($post);
            $photoCityModel->alias = LocoTranslitFilter::cyrillicToLatin($photoCityModel->title);
            $photoCityModel->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());

            if ($photoCityModel->save()) {
                $photoPath = Yii::app()->params['admin']['files']['tmp'] . $photoCityModel->photo;
                $image = Yii::app()->image->load($photoPath);
                $image->save(Yii::app()->params['admin']['files']['photoCity'] . $photoCityModel->photo);

                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }

                unset(Yii::app()->session['photoCity']);

                Yii::app()->user->setFlash(
                    'success',
                    Yii::t('main', 'Спасибо. Ваша фотография добавлена')
                );

                $this->redirect(Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/photo'));
            } else {
                Yii::app()->user->setFlash('error', Yii::t('main', 'Вы допустили ошибки при добавлении фотографии'));
            }
        }

        $this->processForm($photoCityModel);
    }

    /**
     * Загрузка фото на странице
     */
    public function actionUpload()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app(
        )->params['admin']['images']['sizeLimit']);
        $result = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

        Yii::app()->session['photoCity'] = $result['filename'];

        $this->respondJSON($result);
    }

    /** @var PhotoCity $photoCityModel */
    private function processForm($photoCityModel)
    {
        $this->render('photoCity', [
                'photoCityModel' => $photoCityModel
            ]);
    }

}