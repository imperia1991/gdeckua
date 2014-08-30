<?php

/**
 * Class SearchController
 */
class SearchController extends Controller
{

    /**
     * @var string index dir as alias path from <b>application.</b>  , default to <b>runtime.search</b>
     */
    private $_indexFiles = 'runtime.search';


    /**
     * @param string $search
     * @param string $selectDistrict
     * @return array
     */
    public function search($search = '', $selectDistrict = '')
    {
        Yii::import('application.vendors.*');
        require_once('Zend/Search/Lucene.php');

        Zend_Search_Lucene_Analysis_Analyzer::setDefault(
            new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive()
        );
        Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('UTF-8');

        $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles));

        $modeSearch = [
            0 => [
                0 => true,
                1 => true,
                2 => true,
                3 => true,
                4 => true,
                5 => true,
            ],
            1 => [
                0 => true,
                1 => true,
                2 => true,
                3 => true,
                4 => true,
                5 => false,
            ],
            2 => [
                0 => true,
                1 => true,
                2 => true,
                3 => true,
                4 => null,
                5 => null,
            ],
            3 => [
                0 => true,
                1 => true,
                2 => true,
                3 => null,
                4 => null,
                5 => null,
            ],
            4 => [
                0 => true,
                1 => true,
                2 => null,
                3 => null,
                4 => null,
                5 => null,
            ],
            5 => [
                0 => null,
                1 => true,
                2 => true,
                3 => true,
                4 => true,
                5 => true,
            ],
            6 => [
                0 => null,
                1 => true,
                2 => true,
                3 => true,
                4 => true,
                5 => null,
            ],
            7 => [
                0 => null,
                1 => true,
                2 => true,
                3 => true,
                4 => null,
                5 => null,
            ],
            8 => [
                0 => null,
                1 => true,
                2 => true,
                3 => null,
                4 => null,
                5 => null,
            ],
            9 => [
                0 => true,
                1 => null,
                2 => true,
                3 => true,
                4 => true,
                5 => true,
            ],
            10 => [
                0 => true,
                1 => null,
                2 => true,
                3 => true,
                4 => true,
                5 => null,
            ],
            11 => [
                0 => true,
                1 => null,
                2 => true,
                3 => true,
                4 => null,
                5 => null,
            ],
            12 => [
                0 => true,
                1 => null,
                2 => true,
                3 => null,
                4 => null,
                5 => null,
            ],
            13 => [
                0 => true,
                1 => true,
                2 => null,
                3 => true,
                4 => true,
                5 => true,
            ],
            14 => [
                0 => true,
                1 => true,
                2 => null,
                3 => true,
                4 => true,
                5 => null,
            ],
            15 => [
                0 => true,
                1 => null,
                2 => null,
                3 => true,
                4 => null,
                5 => null,
            ],
            16 => [
                0 => true,
                1 => null,
                2 => null,
                3 => null,
                4 => true,
                5 => null,
            ],
            17 => [
                0 => true,
                1 => null,
                2 => null,
                3 => null,
                4 => null,
                5 => true,
            ],
            18 => [
                0 => null,
                1 => true,
                2 => null,
                3 => true,
                4 => null,
                5 => null,
            ],
            19 => [
                0 => null,
                1 => true,
                2 => null,
                3 => null,
                4 => true,
                5 => null,
            ],
            20 => [
                0 => null,
                1 => true,
                2 => null,
                3 => null,
                4 => null,
                5 => true,
            ],
            21 => [
                0 => null,
                1 => null,
                2 => true,
                3 => null,
                4 => true,
                5 => null,
            ],
            22 => [
                0 => null,
                1 => null,
                2 => true,
                3 => null,
                4 => null,
                5 => true,
            ],
            23 => [
                0 => null,
                1 => null,
                2 => null,
                3 => true,
                4 => true,
                5 => null,
            ],
            24 => [
                0 => null,
                1 => null,
                2 => null,
                3 => true,
                4 => null,
                5 => true,
            ],
            25 => [
                0 => null,
                1 => null,
                2 => null,
                3 => null,
                4 => true,
                5 => true,
            ],
            26 => [
                0 => true,
                1 => null,
                2 => null,
                3 => null,
                4 => null,
                5 => null,
            ],
            27 => [
                0 => null,
                1 => true,
                2 => null,
                3 => null,
                4 => null,
                5 => null,
            ],
            28 => [
                0 => null,
                1 => null,
                2 => true,
                3 => null,
                4 => null,
                5 => null,
            ],
            29 => [
                0 => null,
                1 => null,
                2 => null,
                3 => true,
                4 => null,
                5 => null,
            ],
//            26 => array(
//                0 => null,
//                1 => null,
//                2 => null,
//                3 => null,
//                4 => null,
//                5 => null,
//            ),
        ];

        $termsArray = explode(' ', trim(mb_strtolower($search, 'utf-8')));
        $termsArray = array_slice($termsArray, 0, 6);

        if ($selectDistrict) {
            $title = 'title_' . Yii::app()->getLanguage();
            $criteria = new CDbCriteria();
            $criteria->select = $title;
            $criteria->condition = 'id = ' . (int)$selectDistrict;
            $district = Districts::model()->find($criteria);

            $districtTitle = CHtml::encode(str_replace([' ', '/', '.', ',', '\\', '-'], '', $district->{$title}));
            $districtTitle = mb_strtolower($districtTitle, 'utf-8');
            array_unshift($termsArray, trim($districtTitle));

            $termsArray = array_unique($termsArray);

            $districtModeSearch = [];
            foreach ($modeSearch as $mode) {
                if ($mode[0] === null) {
                    continue;
                } elseif ($mode[1] === null) {
                    continue;
                }

                $districtModeSearch[] = $mode;
            }

            unset($modeSearch);

            $modeSearch = $districtModeSearch;
        }

        $termsArray = array_diff($termsArray, ['']);

        $results = [];
        if (count($termsArray) == 1) {
            $query = new Zend_Search_Lucene_Search_Query_MultiTerm();

            foreach ($termsArray as $term) {
                $term = str_replace('"', '', $term);
                $term = str_replace("'", '', $term);
                $term = trim(strip_tags($term));

                $query->addTerm(new Zend_Search_Lucene_Index_Term($term), true);
            }

            $results = $index->find($query);
        } else {
            $countModeSearch = count($modeSearch);

            $step = 0;
            while (!count($results) && $step < $countModeSearch) {
                $query = new Zend_Search_Lucene_Search_Query_MultiTerm();

                $countTerm = 0;
                foreach ($termsArray as $term) {
                    $term = str_replace('"', '', $term);
                    $term = str_replace("'", '', $term);
                    $term = trim(strip_tags($term));

                    $mode = $countTerm <= 5 ? (bool)$modeSearch[$step][$countTerm] : null;

                    $query->addTerm(new Zend_Search_Lucene_Index_Term($term), $mode);

                    $countTerm++;
                }

                $results = $index->find($query);

                $step++;

                unset($query);
            }
        }

        return compact('results', 'term', 'query');
    }

}