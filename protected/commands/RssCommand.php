<?php


/**
 * Class RssCommand
 */
class RssCommand extends CConsoleCommand
{
    /**
     * @param array $args
     */
    public function run($args)
    {
        $rssSites = RssSites::model()->findAll('is_deleted = 0');

        $this->parseRss($rssSites);

        foreach ($rssSites as $rssSite) {

        }
    }

    /**
     * @param RssSites[] $rssSites
     */
    private function parseRss($rssSites)
    {
        $successSites = [];
        foreach ($rssSites as $rssSite) {
            /**@var SimplePie $feed */
            $feed = Yii::app()->simplepie->config([
                'set_feed_url'       => $rssSite->url,
                'enable_cache'       => false,
                'set_cache_location' => Yii::app()->runtimePath . DIRECTORY_SEPARATOR . 'cache',
                'set_cache_duration' => 30 * 24 * 3600,
            ])
                ->parse();

            if (is_object($feed)) {
                $this->add($feed, $rssSite);

                $successSites[$rssSite->getId()] = $rssSite;
            }
        }

        $this->saveMessages($rssSites, $successSites);
    }


    /**
     * @param $feed
     * @param RssSites $rssSite
     *
     * @throws CDbException
     */
    private function add($feed, $rssSite)
    {
        foreach ($feed->items as $item) {
            $pubDate = time();
            if (isset($item['date'])) {
                $pubDate = $item['date'];
            } elseif (isset($item['pubDate'])) {
                $pubDate = $item['pubDate'];
            }

            try {
                $titleNews = $item['title'];
                if (mb_detect_encoding($titleNews) != 'UTF-8') {
                    $titleNews = html_entity_decode(str_replace('&amp;', '&', $item['title']), ENT_QUOTES, 'UTF-8');
                }

                /** @var CDbCommand $command */
                $command = Yii::app()->db->createCommand();
                $command->insert('rss_content', [
                    'title_news'  => $titleNews,
                    'url'         => $item['link'],
                    'add_at'      => Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', strtotime($pubDate)),
                    'rss_site_id' => $rssSite->id,
                    'created_at'  => Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time()),
                ]);

                $command->execute();
            } catch (Exception $e) {
            }
        }

    }


    /**
     * @param RssSites[] $rssSites
     * @param RssSites[] $successSites
     */
    private function saveMessages($rssSites, $successSites)
    {
        foreach ($rssSites as $rssSite) {
            if (isset($successSites[$rssSite->getId()])) {
                $rssSite->setMessage('<span style="color:forestgreen">Последний раз считывалось ' . Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm', time()) . '</span>');
            } else {
                $rssSite->setIsRead(0);
                $rssSite->setMessage('<span style="color:#FF0000">Ошибка. Rss с даного сайта не считывается</span>');
            }

            $rssSite->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', $rssSite->created_at);
            $rssSite->save(false);
        }
    }

} 