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
        foreach ($rssSites as $rssSite) {
            $feed = Yii::app()->simplepie->config([
                                                      'set_feed_url'       => $rssSite->url,
                                                      'enable_cache'       => false,
                                                      'set_cache_location' => Yii::app()->runtimePath . DIRECTORY_SEPARATOR . 'cache',
                                                      'set_cache_duration' => 30 * 24 * 3600,
                                                  ])
                ->parse();


            if (is_object($feed)) {
                $this->add($feed, $rssSite);
            }
        }
    }


    /**
     * @param $feed
     * @param RssSites $rssSite
     *
     * @throws CDbException
     */
    private function add($feed, $rssSite)
    {
//        $rssContent = RssContent::model();
//        $transaction = $rssContent->dbConnection->beginTransaction();

        $dublicate = [];
        foreach ($feed->items as $item) {
            if (isset($dublicate[$item['link']])) {
                continue;
            }

            $pubDate = time();
            if (isset($item['date'])) {
                $pubDate = $item['date'];
            } elseif (isset($item['pubDate'])) {
                $pubDate = $item['pubDate'];
            }

            try {
                /** @var CDbCommand $command */
                $command = Yii::app()->db->createCommand();
                $command->insert('rss_content', [
                    'title_news' => $item['title'],
                    'url' => $item['link'],
                    'add_at' => Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', strtotime($pubDate)),
                    'rss_site_id' => $rssSite->id,
                    'created_at' => Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time()),
                ]);

                $command->execute();

//                $transaction->commit();
            } catch (Exception $e) {
                echo '<pre>';
                print_r($e->getMessage());
                echo '</pre>';
            }
        }

//        $rssContent->dbConnection->active = false;
    }

} 