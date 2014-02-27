<div class="language-switcher">
    <div class="current <?php echo $currentLang; ?>">
        <a href="<?php echo $this->getOwner()->createMultilanguageReturnUrl(Yii::app()->getLanguage()); ?>" lang="<?php echo Yii::app()->getLanguage(); ?>"><?php echo $languages[Yii::app()->getLanguage()]; ?></a>
    </div><!-- /.current -->
    <div class="options">
        <ul>
            <?php foreach($languages as $key => $lang): ?>
                <?php if ($key == $currentLang) continue; ?>
                <li class="<?php echo $key; ?>">
                    <a href="<?php echo $this->getOwner()->createMultilanguageReturnUrl($key); ?>"><?php echo $lang; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div><!-- /.options -->
</div>