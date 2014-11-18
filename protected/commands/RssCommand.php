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
            $feeds = $this->getFeeds($rssSite->getUrl());

            if ($feeds) {
                $this->add($feeds, $rssSite);

                $successSites[$rssSite->getId()] = $rssSite;
            }
        }

        $this->saveMessages($rssSites, $successSites);
    }

    private function getAllNews()
    {
        /** @var CDbCommand $command */
        $command = Yii::app()->db->createCommand();
        $fetch = $command->select('url')
            ->from('rss_content')
            ->queryAll();

        $result = [];
        foreach ($fetch as $item) {
            $result[$item['url']] = $item['url'];
        }

        return $result;
    }

    private function getFeeds($feedUrl)
    {
        $rawFeed = file_get_contents($feedUrl);

        // give an XML object to be iterate
        $xml = new SimpleXMLElement($rawFeed);

        return isset($xml->channel->item) ? $xml->channel->item : false;
    }

    /**
     * @param SimpleXMLElement[] $feeds
     * @param RssSites $rssSite
     *
     * @throws CDbException
     */
    private function add($feeds, $rssSite)
    {
        foreach ($feeds as $item) {
            if (RssContent::model()->exists('url=:url', ['url' => $item->link])) {
                continue;
            }

            $pubDate = time();
            if (isset($item->date)) {
                $pubDate = $item->date;
            } elseif (isset($item->pubDate)) {
                $pubDate = $item->pubDate;
            }

            try {
                /** @var CDbCommand $command */
                $command = Yii::app()->db->createCommand();
                $command->insert('rss_content', [
                    'title_news'  => $item->title,
                    'url'         => $item->link,
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