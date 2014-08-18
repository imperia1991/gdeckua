<?php
/** @var PhotoCity $photoCityModel */
?>

<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'Фотографии города')
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
<div class="row collapse">
<div class="large-10 medium-12 small-12 columns left-foto-section" >
    <ul class="tabs" data-tab>
        <li class="tab-title active photo">
            <a href="#panel2-1"><?php echo Yii::t('main', 'Фотографии города'); ?></a>
        </li>
        <li class="tab-title event">
            <a href="#panel2-2"><?php echo Yii::t('main', 'Фотографии мероприятий'); ?></a>
        </li>
        <li>
            <form class="link-add-photo-city" action="<?php echo Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/photo/add'); ?>">
                <input class="button-load" style="float:right;"type="submit" value="<?php echo Yii::t('main', 'Добавить фотографию'); ?>">
            </form>
        </li>
    </ul>
<script type="text/javascript">
    $(document).ready(function(){
        $(".event").on('click', function(){
            $(".button-load").toggle();
        });
        $(".photo").on('click', function(){
            $(".button-load").show();
        });
    });
</script>
<div class="tabs-content">
<div class="content active row" id="panel2-1">
    <?php $this->renderPartial(
        'partials/_photos',
        [
            'photos' => $photos,
        ]
    ) ?>

    <div class="large-4 columns foto-inner">
        <div class="row collapse">
            <div class="large-12 columns foto-inner-title"><h3>Люди сидят смотрят)</h3></div>
            <div class="large-12 columns foto-inner-img">
                <a href="img/kamin.png" class="gallery" title="Черкасский государственный технологический университет">
                    <img src="img/kamin.png">
	            						<span class="large-lupa">
	            							<img src="img/large(new).png">
	            						</span>
                </a>
            </div>
            <div class="large-12 columns foto-inner-text"><p>фото: Иванов Иван Иванович</p></div>
            <div class="large-12 columns foto-inner-soc">
                <ul class="soc-icons-list">
                    <li><img src="img/vk-like.png"></li>
                    <li><img src="img/fb-like.png"></li>
                    <li><img src="img/ok-like.png"></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="large-12 columns show-other-news">
        <a href="#">Показать еще фотографии</a>
    </div>

</div>

<div class="content row" id="panel2-2">
    <div class="large-6 columns event-inner">
        <div class="row collapse">
            <div class="row collapse event-inner-title">
                <div class="large-9 columns"><h3>Люди сидят смотрят пьют пиво)</h3></div>
                <div class="large-3 columns"><p>Добавлено</p><p>06.06.06</p></div>
            </div>
            <div class="large-12 columns foto-inner-img">
                <a  title="Черкасский государственный технологический университет">
                    <img src="img/kamin.png">
                </a>
            </div>
            <div class="large-12 columns foto-inner-text"><p>фото: Иванов Иван Иванович www.vk.com</p></div>
            <div class="large-12 columns foto-inner-soc">
                <ul class="soc-icons-list">
                    <li><img src="img/vk-like.png"></li>
                    <li><img src="img/fb-like.png"></li>
                    <li><img src="img/ok-like.png"></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="large-6 columns event-inner">
        <div class="row collapse">
            <div class="row collapse event-inner-title">
                <div class="large-9 columns"><h3>Люди сидят смотрят пьют пиво)</h3></div>
                <div class="large-3 columns"><p>Добавлено</p><p>06.06.06</p></div>
            </div>
            <div class="large-12 columns foto-inner-img">
                <a  title="Черкасский государственный технологический университет">
                    <img src="img/kamin.png">
                </a>
            </div>
            <div class="large-12 columns foto-inner-text"><p>фото: Иванов Иван Иванович www.vk.com</p></div>
            <div class="large-12 columns foto-inner-soc">
                <ul class="soc-icons-list">
                    <li><img src="img/vk-like.png"></li>
                    <li><img src="img/fb-like.png"></li>
                    <li><img src="img/ok-like.png"></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="large-6 columns event-inner">
        <div class="row collapse">
            <div class="row collapse event-inner-title">
                <div class="large-9 columns"><h3>Люди сидят смотрят пьют пиво)</h3></div>
                <div class="large-3 columns"><p>Добавлено</p><p>06.06.06</p></div>
            </div>
            <div class="large-12 columns foto-inner-img">
                <a  title="Черкасский государственный технологический университет">
                    <img src="img/kamin.png">
                </a>
            </div>
            <div class="large-12 columns foto-inner-text"><p>фото: Иванов Иван Иванович www.vk.com</p></div>
            <div class="large-12 columns foto-inner-soc">
                <ul class="soc-icons-list">
                    <li><img src="img/vk-like.png"></li>
                    <li><img src="img/fb-like.png"></li>
                    <li><img src="img/ok-like.png"></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="large-6 columns event-inner">
        <div class="row collapse">
            <div class="row collapse event-inner-title">
                <div class="large-9 columns"><h3>Люди сидят смотрят пьют пиво)</h3></div>
                <div class="large-3 columns"><p>Добавлено</p><p>06.06.06</p></div>
            </div>
            <div class="large-12 columns foto-inner-img">
                <a  title="Черкасский государственный технологический университет">
                    <img src="img/kamin.png">
                </a>
            </div>
            <div class="large-12 columns foto-inner-text"><p>фото: Иванов Иван Иванович www.vk.com</p></div>
            <div class="large-12 columns foto-inner-soc">
                <ul class="soc-icons-list">
                    <li><img src="img/vk-like.png"></li>
                    <li><img src="img/fb-like.png"></li>
                    <li><img src="img/ok-like.png"></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="large-12 columns show-other-news">
        <a href="#">Показать еще события</a>
    </div>

</div>
</div>
</div>

<!-- RIGHT SECTION NEWS -->
<?php $this->renderPartial('/partials/_previewNews'); ?>
<!-- RIGHT SECTION NEWS -->


</div>
</div>