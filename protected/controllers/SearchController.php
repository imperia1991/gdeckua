<?php

/**
 * Class SearchController
 */
class SearchController extends Controller
{
    /**
     * @param string $term
     * @param string $selectDistrict
     * @return array
     */
    public function search($term = '', $selectDistrict = '')
    {

        $term = trim($term, ' @!?/\\%^');

        /** @var SphinxClient $search */
        $search = Yii::App()->search;
        $search->setSelect('*');
        $search->setArrayResult(true);
        $search->setMatchMode(SPH_MATCH_EXTENDED2);

        if ($selectDistrict) {
            $search->setFilter('district_id', [$selectDistrict]);

            if (empty($term)) {
                $search->setMatchMode(SPH_MATCH_FULLSCAN);
            }
        }

        $resArray = $search->Query(str_replace('/', '', $term), 'gdeckua_index');

//        $phrases = $this->prepareTerm($term);
//        if (count($phrases) > 1) {
//            foreach ($phrases as $phrase) {
//                $search->AddQuery($phrase, 'gdeckua_index');
//            }
//        } else {
//            $search->AddQuery($phrases, 'gdeckua_index');
//        }
//
//        $resArray = $search->RunQueries();

        $ids = [];
        if (!empty($resArray)) {
//            foreach ($resArray as $item) {
//                if (isset($item['matches'])) {
//                    foreach ($item['matches'] as $match) {
//                        if (!isset($ids[$match['id']]) || $ids[$match['id']] < $match['weight']) {
//                            $ids[$match['id']] = $match['weight'];
//                        }
//                    }
//                }
//            }

            foreach ($resArray['matches'] as $item) {
                $ids[$item['id']] = $item['weight'];
            }

            arsort($ids);
        }

        if (empty($ids)) {
            $search = Yii::App()->search;
            $search->setSelect('*');
            $search->setArrayResult(true);
            $search->setMatchMode(SPH_MATCH_ANY);

            if ($selectDistrict) {
                $search->setFilter('district_id', [$selectDistrict]);

                if (empty($term)) {
                    $search->setMatchMode(SPH_MATCH_FULLSCAN);
                }
            }

            $resArray = $search->Query($term, 'gdeckua_index');

            foreach ($resArray['matches'] as $item) {
                $ids[$item['id']] = $item['weight'];
            }

            arsort($ids);
        }

        return $ids;
    }

    private function prepareTerm($term, $countText = 6) {
        $termArray = explode(' ', $term);

        $countWords = count($termArray);

        if ($countWords == 1) {
            return join(' ', $termArray);
        }

        if ($countWords > $countText) {
            $termArray = array_slice($termArray, 0, $countText);
            $countWords = count($termArray);
        }

        $result = [];
        while($countWords > 1) {
            $result[] = join(' ', $termArray);

            $limitedCount = $countWords - 1;
            for ($i = 1; $i <= $limitedCount; $i++) {
                $result[] = join(' ', array_slice($termArray, 0, $countWords - $i));
            }

            $termArray = array_slice($termArray, 1);
            $countWords = count($termArray);
        }

        $result[] = join(' ', $termArray);

        return $result;
    }

}