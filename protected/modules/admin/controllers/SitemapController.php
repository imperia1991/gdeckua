<?php

class SitemapController extends AdminController
{
    public function actionIndex()
    {
        $urls = [];

        $places = Places::model()->findAll([
                'condition' => 'is_deleted = 0'
            ]);

        /** @var Places $place */
        foreach ($places as $place) {
            $date = $place->updated_at ? $place->updated_at : $place->created_at;
            $date = date('c', strtotime($date));
            $urls[] = [
                $this->createAbsoluteUrl('/ru/view/' . $place->id . '/' . $place->alias),
                $date
            ];
        }

        /** @var Places $place */
        foreach ($places as $place) {
            $date = $place->updated_at ? $place->updated_at : $place->created_at;
            $date = date('c', strtotime($date));

            $urls[] = [
                $this->createAbsoluteUrl('/uk/view/' . $place->id . '/' . $place->alias),
                $date
            ];
        }


        $news = News::model()->findAll([
          'condition' => 'is_deleted = 0'
        ]);

        /** @var News[] $news */
        foreach ($news as $item) {
            $date = $item->created_at;
            $date = date('c', strtotime($date));
            $urls[] = [
                $this->createAbsoluteUrl('/ru/news/' . $item->id . '/' . $item->alias),
                $date
            ];
        }

        /** @var News[] $news */
        foreach ($news as $item) {
            $date = $item->created_at;
            $date = date('c', strtotime($date));
            $urls[] = [
                $this->createAbsoluteUrl('/uk/news/' . $item->id . '/' . $item->alias),
                $date
            ];
        }

        if ($this->create($urls)) {
            Yii::app()->user->setFlash('success', 'sitemap.xml сформирован');
        } else {
            Yii::app()->user->setFlash('error', 'Ошибка. sitemap.xml не сформирован. Попробуйте позже.');
        }

        $this->redirect(Yii::app()->createUrl('/admin/search'));
    }

    /** @var [] $urls */
    private function create($urls)
    {
        $dom = new DOMDocument('1.0', 'UTF-8');

        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute('xmlns','http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach($urls as $item) {
            $url = $dom->createElement('url');
            $loc = $dom->createElement('loc');
            $lastmod = $dom->createElement('lastmod');
            $changefreq = $dom->createElement('changefreq');
            $priority = $dom->createElement('priority');

            $loc->appendChild($dom->createTextNode($item[0]));
            $lastmod->appendChild($dom->createTextNode($item[1]));
            $changefreq->appendChild($dom->createTextNode('weekly'));
            $priority->appendChild($dom->createTextNode('0.8'));

            $url->appendChild($loc);
            $url->appendChild($lastmod);
            $url->appendChild($changefreq);
            $url->appendChild($priority);

            $urlset->appendChild($url);
        }

        $dom->appendChild($urlset);

        return $dom->save(Yii::getPathOfAlias('webroot') . '/sitemap.xml');
    }


}