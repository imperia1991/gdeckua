<?php
$rss = [
    'http://www.rada.cherkassy.ua/rss/news_68.rss',
    'http://vikka.ua/rss.xml',
    'http://cherkassy-rda.ck.ua/?feed=rss2',
    'http://ck.mns.gov.ua/rss/',
    'http://www.rada.cherkassy.ua/rss/news_17.rss',
];
?>

<div class="row collapse">
    <?php
    $this->widget(
        'ext.ya-simple-feed.YaSimpleFeed',
        [
            'feedUrl'=>$rss[array_rand($rss)],
            // feedSpeed must be an INT (OPTIONAL, by default is 5)
            'feedSpeed'=>5,
            // feedDirection must be a string as 'left','right,'up' or 'down' (OPTIONAL, by default is 'left')
            'feedDirection'=>'left',
        ]
    );
    ?>
</div>