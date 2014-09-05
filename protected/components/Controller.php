<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = [];

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = [];
    /**
     * @var CActiveRecord|Users
     */
    public $modelUser;
    /**
     * @var
     */
    public $keywords;
    /**
     * @var Feedback
     */
    public $feedback;
    /**
     * @var array
     */
    public $districts;
    /**
     * @var
     */
    public $modelPlaces;
    /**
     * @var string
     */
    public $selectDistrict = '';
    /**
     * @var string
     */
    public $checkedString = '';
    /** @var News[] */
    public $previewNews;
    /** @var string Переменная для вывода определнных описаний внизу страниц сайта */
    public $currentPageType = PageTypes::PAGE_DEFAULT;

    /**
     * @param string $id
     * @param null $module
     */
    public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);
        // If there is a post-request, redirect the application to the provided url of the selected language

        $postLanguage = Yii::app()->request->getPost('language', '');
        if ($postLanguage) {
            $lang = $postLanguage;
            $MultilangReturnUrl = $_POST[$lang];
            $this->redirect($MultilangReturnUrl);
        }
        // Set the application language if provided by GET, session or cookie
        $getLanguage = Yii::app()->request->getQuery('language', '');
        if ($getLanguage) {
            Yii::app()->language = $getLanguage;

            Yii::app()->user->setState('language', $getLanguage);

            $cookie = new CHttpCookie('language', $getLanguage);
            $cookie->expire = time() + (60 * 60 * 24 * 365); // (1 year)
            Yii::app()->request->cookies['language'] = $cookie;
        } else {
            if (Yii::app()->user->hasState('language')) {
                Yii::app()->language = Yii::app()->user->getState('language');
            } else {
                if (isset(Yii::app()->request->cookies['language'])) {
                    Yii::app()->language = Yii::app()->request->cookies['language']->value;
                } else {
                    Yii::app()->language = 'uk';
                }
            }
        }

        Yii::app()->sourceLanguage = Yii::app()->getLocale();

        $this->modelUser = Yii::app()->user->isGuest ? new Users('login') : Users::model()->findByPk(
            Yii::app()->user->id
        );

        new JsTrans('main', Yii::app()->language, Yii::app()->language);

        $this->feedback = new Feedback();

        if (!isset(Yii::app()->session['totalItemCount'])) {
            Yii::app()->session['totalItemCount'] = (new Places())->getTotalItemCount();
        }

        $criteria = new CDbCriteria();
        $criteria->order = 'title_' . Yii::app()->getLanguage() . ' ASC';
        $this->districts = CHtml::listData(
            Districts::model()->findAllByAttributes([], $criteria),
            'id',
            'title_' . Yii::app()->getLanguage()
        );

        $this->previewNews = News::model()->getPreviewNews();
    }

    /**
     * @param string $lang
     * @return string
     */
    public function createMultilanguageReturnUrl($lang = 'ru')
    {
        if (count($_GET) > 0) {
            $arr = $_GET;
            $arr['language'] = $lang;
        } else {
            $arr = ['language' => $lang];
        }

        return $this->createUrl('', $arr);
    }

    /**
     * @param $data
     */
    protected function respondJSON($data)
    {
        header('Content-type: application/json');
        echo CJSON::encode($data);

        Yii::app()->end();
    }

    /**
     * @param string $param
     */
    protected function processPageRequest($param = 'page')
    {
        if (Yii::app()->request->isAjaxRequest && null !== Yii::app()->getRequest()->getPost($param, null)) {
            $_GET[$param] = Yii::app()->request->getPost($param);
        }
    }
}