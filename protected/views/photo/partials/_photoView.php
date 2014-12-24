<?php /** @var PhotoCity[] $photoItems */ ?>
<?php $photoItems = $photos->getData(); ?>
<?php foreach ($photoItems as $photo): ?>
    <?php $this->renderPartial('partials/_onePhoto', [
                'data' => $photo
            ]) ?>
<?php endforeach; ?>