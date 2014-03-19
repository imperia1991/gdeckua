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
        $query = new Zend_Search_Lucene_Search_Query_Phrase(explode(' ', trim(mb_strtolower($search, 'utf-8'))));
        $results = $index->find($query);

        return compact('results', 'term', 'query');

        return array();
    }

}
?>
