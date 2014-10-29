<?php
/**
 * Description of SearchController
 *
 * @author Геннадий
 */
class SearchController extends AdminController
{
    /**
     * @var string index dir as alias path from <b>application.</b>  , default to <b>runtime.search</b>
     */
    private $_indexFiles = 'runtime.search';

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
        Yii::import('application.vendors.*');
        require_once('Zend/Search/Lucene.php');

        $this->menuActive = 'search';

        parent::init();
    }

    /**
     * Search index creation
     */
    public function actionCreate()
    {
        $result = exec('sudo indexer --config /etc/sphinxsearch/sphinx.conf --rotate --all > /home/admin/web/gdeck.ua/public_html/sphinx-update.log');

        Yii::app()->user->setFlash('success', 'Индексы обновлены');

        $this->render('index');
    }

    public function actionIndex()
    {
        $this->render('index');
    }
}

