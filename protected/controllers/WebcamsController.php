<?php

/**
 * Class WebcamsController
 */
class WebcamsController extends Controller
{
    /**
     * Declares class-based actions.
     */
//    public function actions()
//    {
//        return [
//            // captcha action renders the CAPTCHA image displayed on the contact page
//            'captcha' => [
//                'class' => 'CCaptchaAction',
//                'backColor' => 0x494949,
//                'foreColor' => 0xFFFFFF
//            ],
//        ];
//    }

    /**
     *
     */
    public function actionIndex()
    {
        $this->render('index',[]);
    }

}