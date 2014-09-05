<?php
$this->breadcrumbs = [
    '' => Yii::t('main', 'Веб-камеры')
];
$this->renderPartial('/partials/_breadcrumbs');
?>

<div class="large-12 columns">
    <div class="row collapse">

        <div class="large-10 medium-9 small-12 columns left-sector-web-cam afisha-section">
            <ul class="tabs" data-tab>
                <li class="tab-title active photo">
                    <a href="#panel2-1"><?php echo Yii::t('main', 'Соборная площадь') ?></a>
                </li>
                <li class="tab-title event">
                    <a href="#panel2-2"><?php echo Yii::t('main', 'Горисполком. Зал заседаний') ?></a>
                </li>
                <li class="tab-title event">
                    <a href="#panel2-3"><?php echo Yii::t('main', 'Горисполком. Президиум') ?></a>
                </li>
                <li class="tab-title event">
                    <a href="#panel2-4"><?php echo Yii::t('main', 'ОГА') ?></a>
                </li>
            </ul>
            <div class="tabs-content">
                <div class="content active row" id="panel2-1">
                    <div class="row collapse">
                        <div class="large-12 medium-12 small-12 columns webcam-box" style="text-align: center;height: 680px;">
                            <script language="JavaScript">
                                <!--
                                //var BaseURL = "http://82.207.68.254/";
                                var BaseURL = "http://82.207.52.38/";

                                var DisplayWidth = "840";
                                var DisplayHeight = "680";

                                var File = "axis-cgi/mjpg/video.cgi?resolution=640x480";
                                var output = "";
                                if ((navigator.appName == "Microsoft Internet Explorer") &&
                                    (navigator.platform != "MacPPC") && (navigator.platform != "Mac68k"))
                                {
                                    output  = '<OBJECT ID="Player" width='
                                    output += DisplayWidth;
                                    output += ' height=';
                                    output += DisplayHeight;
                                    output += ' CLASSID="CLSID:DE625294-70E6-45ED-B895-CFFA13AEB044" ';
                                    output += 'CODEBASE="';
                                    output += BaseURL;
                                    output += 'activex/AMC.cab#version=4,1,4,0">';
                                    output += '<PARAM NAME="MediaURL" VALUE="';
                                    output += BaseURL;
                                    output += File + '">';
                                    output += '<param name="MediaType" value="mjpeg-unicast">';
                                    output += '<param name="ShowStatusBar" value="0">';
                                    output += '<param name="ShowToolbar" value="0">';
                                    output += '<param name="AutoStart" value="1">';
                                    output += '<param name="StretchToFit" value="1">';
                                    output += '<BR><B>Axis Media Control</B><BR>';
                                    output += 'The AXIS Media Control, which enables you ';
                                    output += 'to view live image streams in Microsoft Internet';
                                    output += ' Explorer, could not be registered on your computer.';
                                    output += '<BR></OBJECT>';
                                } else {
                                    theDate = new Date();
                                    output  = '<IMG SRC="';
                                    output += BaseURL;
                                    output += File;
                                    output += '&dummy=' + theDate.getTime().toString(10);
                                    output += '" HEIGHT="';
                                    output += DisplayHeight;
                                    output += '" WIDTH="';
                                    output += DisplayWidth;
                                    output += '" ALT="<?php echo Yii::t('main', 'Соборная площадь') ?>">';
                                }
                                document.write(output);
                                document.Player.ToolbarConfiguration = "play,+snapshot,+fullscreen"
                                -->
                            </script>
                        </div>
                    </div>
                </div>
                <div class="content row" id="panel2-2">
                    <div class="row collapse">
                        <div class="large-12 medium-12 columns webcam-box">
                            <iframe width="820" height="700" frameborder="0" align="middle" src="http://rada.ck.ua/stream/camera.php">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="content row" id="panel2-3">
                    <div class="row collapse">
                        <div class="large-12 medium-12 columns webcam-box">
                            <iframe width="820" height="700" frameborder="0" align="middle" src="http://rada.ck.ua/stream/camera2.php">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="content row" id="panel2-4">
                    <div class="row collapse">
                        <div class="large-12 medium-12 columns webcam-box" style="text-align: center;">
                            <iframe width="450" height="286" frameborder="0" scrolling="no" src="http://www.ustream.tv/embed/17537393?v=3&amp;wmode=direct" style="border: 0px none transparent;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SECTION NEWS -->
        <?php $this->renderPartial('/partials/_previewNews'); ?>
        <!-- RIGHT SECTION NEWS -->


    </div>
</div>