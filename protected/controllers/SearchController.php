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
        $term = trim($term, 'utf-8');

        /** @var SphinxClient $search */
        $search = Yii::App()->search;
        $search->setSelect('*');
        $search->setArrayResult(true);
        $search->setMatchMode(SPH_MATCH_EXTENDED2);
//        $search->SetSortMode(SPH_SORT_RELEVANCE);

        if ($selectDistrict) {
            $search->setFilter('district_id', [$selectDistrict]);

            if (empty($term)) {
                $search->setMatchMode(SPH_MATCH_FULLSCAN);
            }
        }

        $resArray = $search->Query($term, 'gdeckua_index');

        if (empty($resArray['total'])) {
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
        }

        $ids = [];
        if (count($resArray)) {
            foreach ($resArray['matches'] as $item) {
                $ids[] = $item['id'];
            }
        }

        return $ids;
    }

}