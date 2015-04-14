<?php if ($meetings->getTotalItemCount() > $meetings->getPagination()->pageSize
&& $clubs->getTotalItemCount() > $clubs->getPagination()->pageSize): ?>
    <div id="showNews" class="row collapse">
        <div class="show-other-news">
            <img id="loading" style="display: none" src="/images/loading.gif" alt="" />
            <a id="showMore" href="javascript:void(0);" class="more_news button"><?php echo Yii::t('main', 'Показать другие новости'); ?></a>
        </div>
    </div>
    <script type="text/javascript">
        /*<![CDATA[*/
        (function($)
        {
            // скрываем стандартный навигатор
            //            $('.paginator').hide();

            // запоминаем текущую страницу и их максимальное количество
            var page = parseInt('<?php echo (int)Yii::app()->request->getParam('page', 1); ?>');
            var pageCountClubs = parseInt('<?php echo (int)$clubs->pagination->pageCount; ?>');
            var pageCountMeetings = parseInt('<?php echo (int)$meetings->pagination->pageCount; ?>');

            var loadingFlag = false;

            $('#showMore').on('click', function()
            {
                // защита от повторных нажатий
                if (!loadingFlag)
                {
                    // выставляем блокировку
                    loadingFlag = true;

                    // отображаем анимацию загрузки
                    $('#showMore').hide();
                    $('#loading').show();

                    $.ajax({
                        type: 'post',
                        url: location.href,
                        data: {
                            // передаём номер нужной страницы методом POST
                            'page': page + 1
                        },
                        success: function(data)
                        {
                            // увеличиваем номер текущей страницы и снимаем блокировку
                            page++;
                            loadingFlag = false;

                            // прячем анимацию загрузки
                            $('#loading').hide();
                            $('#showMore').show();

                            // вставляем полученные записи после имеющихся в наш блок
                            if (page <= pageCountMeetings) {
	                            $('#meetingView').append(data.meetingView);
                            }
	                        if (page <= pageCountClubs) {
		                        $('#clubView').append(data.clubView);
	                        }

                            // если достигли максимальной страницы, то прячем кнопку
                            if (page >= pageCountClubs && page >= pageCountMeetings)
                                $('#showNews').hide();
                        },
                        done: function()
                        {
                            $('#loading').hide();
                            $('#showMore').show();
                        }
                    });
                }
                return false;
            })
        })(jQuery);
        /*]]>*/
    </script>
<?php endif; ?>