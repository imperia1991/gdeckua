<?php

set_time_limit(0);

/**
 * Class SitemapCommand
 */
class SitemapCommand extends CConsoleCommand
{

	/**
	 * @param array $args
	 */
	public function run($args)
    {
	    $siteUrl = trim(Yii::app()->params['siteUrl'], '/');
	    $urls = [];

	    $places = Places::model()->findAll([
		    'condition' => 'is_deleted = 0'
	    ]);

	    /** @var Places $place */
	    foreach ($places as $place) {
		    $date = $place->updated_at ? $place->updated_at : $place->created_at;
		    $date = date('c', strtotime($date));
		    $urls[] = [

			    $siteUrl . '/ru/view/' . $place->id . '/' . $place->alias,
			    $date
		    ];
	    }

	    /** @var Places $place */
	    foreach ($places as $place) {
		    $date = $place->updated_at ? $place->updated_at : $place->created_at;
		    $date = date('c', strtotime($date));

		    $urls[] = [
			    $siteUrl . '/uk/view/' . $place->id . '/' . $place->alias,
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
			    $siteUrl . '/ru/news/' . $item->id . '/' . $item->alias,
			    $date
		    ];
	    }

	    /** @var News[] $news */
	    foreach ($news as $item) {
		    $date = $item->created_at;
		    $date = date('c', strtotime($date));
		    $urls[] = [
			    $siteUrl . '/uk/news/' . $item->id . '/' . $item->alias,
			    $date
		    ];
	    }

	    $categories = CategoryPosters::model()->findAll();

	    /** @var CategoryPosters[] $categoryPosters */
	    foreach ($categories as $item) {
		    $date = date('c', strtotime("01.09.2014"));
		    $urls[] = [
			    $siteUrl . '/ru/poster/' . $item->alias,
			    $date
		    ];
	    }

	    /** @var CategoryPosters[] $categoryPosters */
	    foreach ($categories as $item) {
		    $date = date('c', strtotime("01.09.2014"));
		    $urls[] = [
			    $siteUrl . '/uk/poster/' . $item->alias,
			    $date
		    ];
	    }

	    $categories = CategoryNews::model()->findAll();

	    /** @var CategoryPosters[] $categoryPosters */
	    foreach ($categories as $item) {
		    $date = date('c', strtotime("01.09.2014"));
		    $urls[] = [
			    $siteUrl . '/ru/news/' . $item->aliases,
			    $date
		    ];
	    }

	    /** @var CategoryPosters[] $categoryPosters */
	    foreach ($categories as $item) {
		    $date = date('c', strtotime("01.09.2014"));
		    $urls[] = [
			    $siteUrl . '/uk/news/' . $item->aliases,
			    $date
		    ];
	    }

	    $chashkaChes = NewsChaska::model()->findAll('status = ' . NewsChaska::STATUS_SHOW);

	    /** @var NewsChaska[] $chashkaChes */
	    foreach ($chashkaChes as $item) {
		    $date = $item->updated_at ? $item->updated_at : $item->created_at;
		    $date = date('c', strtotime($date));
		    $urls[] = [
			    $siteUrl . '/ru/chashka-che/' . $item->alias,
			    $date
		    ];
	    }

	    /** @var NewsChaska[] $chashkaChes */
	    foreach ($chashkaChes as $item) {
		    $date = $item->updated_at ? $item->updated_at : $item->created_at;
		    $date = date('c', strtotime($date));
		    $urls[] = [
			    $siteUrl . '/uk/chashka-che/' . $item->alias,
			    $date
		    ];
	    }

	    $this->create($urls);
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

		return $dom->save(Yii::getPathOfAlias('webroot') . '/../sitemap.xml');
	}
}