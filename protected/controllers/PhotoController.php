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

        $this->render(
            'index',
            [
            ]
        );
    }

    public function actionAdd()
    {
        $photoCityModel = new PhotoCity();

        $this->processForm($photoCityModel);
    }

    /** @var PhotoCity $photoCityModel */
    private function processForm($photoCityModel)
    {
        $this->render('photoCity', [
                'photoCityModel' => $photoCityModel
            ]);
    }

}