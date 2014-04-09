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
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'roles' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
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
//        setlocale(LC_CTYPE, 'ru_RU.UTF-8');
        Zend_Search_Lucene_Analysis_Analyzer::setDefault(
            new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive());

        $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);

        $places = Places::model()->with(array('tags'))->findAll('is_deleted = 0');
        foreach ($places as $place) {
            $doc = new Zend_Search_Lucene_Document();
//            $doc->addField(Zend_Search_Lucene_Field::unIndexed('place_id', CHtml::encode($place->id), 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('title_ru', CHtml::encode($place->title_ru), 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('title_uk', CHtml::encode($place->title_uk), 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('description_ru', CHtml::encode(strip_tags($place->description_ru)), 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('description_uk', CHtml::encode(strip_tags($place->description_uk)), 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('district_ru', CHtml::encode($place->district->title_ru), 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('district_uk', CHtml::encode($place->district->title_uk), 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('address_ru', CHtml::encode($place->address_ru), 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('address_uk', CHtml::encode($place->address_uk), 'UTF-8'));
//            $doc->addField(Zend_Search_Lucene_Field::unIndexed('photoTitle', CHtml::encode($place->photos[0]->title), 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::unStored('tags', CHtml::encode($place->tags->tags), 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::unIndexed('lat', $place->lat));
            $doc->addField(Zend_Search_Lucene_Field::unIndexed('lng', $place->lng));
            $doc->addField(Zend_Search_Lucene_Field::keyword('country_id', $place->country_id));
            $doc->addField(Zend_Search_Lucene_Field::keyword('region_id', $place->region_id));
            $doc->addField(Zend_Search_Lucene_Field::keyword('city_id', $place->city_id));
            $doc->addField(Zend_Search_Lucene_Field::unIndexed('place_id', $place->id));

            $number = 0;
            foreach ($place->photos as $photo) {
                $title = 'photoTitle_' . $place->id . '_' . ($number++);
                $doc->addField(Zend_Search_Lucene_Field::unIndexed($title, CHtml::encode($photo->title), 'UTF-8'));
            }

            $index->addDocument($doc);
        }

        $index->optimize();
        $index->commit();

        Yii::app()->user->setFlash('success', 'Индексы обновлены');

        $this->render('index');
    }

    public function actionIndex()
    {
        $this->render('index');
    }
}
?>
