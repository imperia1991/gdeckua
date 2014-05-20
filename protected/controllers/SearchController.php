<?php

/**
 * Description of SearchController
 *
 * @author Геннадий
 */
class SearchController extends Controller
{

    /**
     * @var string index dir as alias path from <b>application.</b>  , default to <b>runtime.search</b>
     */
    private $_indexFiles = 'runtime.search';

    public function search($search = '')
    {
        Yii::import('application.vendors.*');
        require_once('Zend/Search/Lucene.php');

        Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive());
        Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('UTF-8');

        $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles));

        $termsArray = explode(' ', trim(mb_strtolower($search, 'utf-8')));
//        $query = new Zend_Search_Lucene_Search_Query_Phrase($termsArray);
//        $results = $index->find($query);
//
//        if (!count($results)) {
            $query = new Zend_Search_Lucene_Search_Query_MultiTerm();


            $terms = array();
            foreach ($termsArray as $term) {
                $term = str_replace('"', '', $term);
                $term = str_replace("'", '', $term);
                $term = trim(strip_tags($term));

                $query->addTerm(new Zend_Search_Lucene_Index_Term($term), null);
            }

    //        $query = new Zend_Search_Lucene_Search_Query_Phrase($terms);
            $results = $index->find($query);
//        }

//        echo '<pre>';
//        print_r($results);
//        echo '</pre>';exit;
        return compact('results', 'term', 'query');

        return array();
    }

}
?>
