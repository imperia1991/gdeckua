<?php

/**
 * Class WebcamsController
 */
class WebcamsController extends Controller
{
    /**
     *
     */
    public function init()
    {
        $this->currentPageType = PageTypes::PAGE_WEBCAMS;

        parent::init();
    }


    /**
     *
     */
    public function actionIndex()
    {
        $this->render('index',[]);
    }

}