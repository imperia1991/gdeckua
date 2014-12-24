<?php
/**
 * Description of SearchController
 *
 * @author Геннадий
 */
class SearchController extends AdminController
{
    public function filters()
    {
        return [
            'accessControl', // perform access control for CRUD operations
        ];
    }

    public function accessRules()
    {
        return [
            ['allow',
                'roles' => ['admin'],
            ],
            ['deny', // deny all users
                'users' => ['*'],
            ],
        ];
    }

    public function init()
    {
        $this->menuActive = 'search';

        parent::init();
    }

    /**
     * Search index creation
     */
    public function actionCreate()
    {
        exec('sudo indexer --config /etc/sphinxsearch/sphinx.conf --rotate --all > /home/gennady/sphinx-update.log');

        Yii::app()->user->setFlash('success', 'Индексы обновлены');

        $this->render('index');
    }

    public function actionIndex()
    {
        $this->render('index');
    }
}

