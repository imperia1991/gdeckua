<div class="row">
    <h4>Настройки поиска</h4>
</div>
<div class="row">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Обновить индексы',
        'type' => null, // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size' => 'small', // null, 'large', 'small' or 'mini'
        'url' => Yii::app()->createUrl('/admin/search/create'),
    ));
    ?>
</div>
<div class="row" style="margin-top: 10px">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Сформировать sitemap.xml',
        'type' => null, // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size' => 'small', // null, 'large', 'small' or 'mini'
        'url' => Yii::app()->createUrl('/admin/sitemap.xml'),
    ));
    ?>
    <label>(Требуется для поисковых роботов. Запускать каждый раз после добавления мест или новостей. Потом перенесу в крон)</label>
</div>