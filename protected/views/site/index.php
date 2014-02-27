<?php
$this->pageTitle = Yii::t('main', 'Главная');
?>
<div id="main">
    <div class="row">
        <div class="span9">
            <h1 class="page-header">Listing rows with filter</h1>

            <div class="properties-rows">
                <div class="row">
                    <div class="property span9">
                        <div class="row">
                            <div class="image span3">
                                <div class="content">
                                    <a href="detail.html"></a>
                                    <img src="/img/tmp/property-small-1.png" alt="">
                                </div><!-- /.content -->
                            </div><!-- /.image -->

                            <div class="body span6">
                                <div class="title-price row">
                                    <div class="title span4">
                                        <h2><a href="detail.html">27523 Pacific Coast</a></h2>
                                    </div><!-- /.title -->

                                    <div class="price">
                                        1 250 000€
                                    </div><!-- /.price -->
                                </div><!-- /.title -->

                                <div class="location">Palo Alto CA</div><!-- /.location -->
                                <p>Etiam at ante id enim dictum posuere id vel est. Praesent at massa quis risus cursus tristique vel non orci. Phasellus ut nisi non odio</p>
                                <div class="area">
                                    <span class="key">Area:</span><!-- /.key -->
                                    <span class="value">120</span><!-- /.value -->
                                </div><!-- /.area -->
                                <div class="bedrooms"><div class="content">4</div></div><!-- /.bedrooms -->
                                <div class="bathrooms"><div class="content">3</div></div><!-- /.bathrooms -->
                            </div><!-- /.body -->
                        </div><!-- /.property -->
                    </div><!-- /.row -->

                    <div class="property span9">
                        <div class="row">
                            <div class="image span3">
                                <div class="content">
                                    <a href="detail.html"></a>
                                    <img src="/img/tmp/property-small-2.png" alt="">
                                </div><!-- /.content -->
                            </div><!-- /.image -->

                            <div class="body span6">
                                <div class="title-price row">
                                    <div class="title span4">
                                        <h2><a href="detail.html">27523 Pacific Coast</a></h2>
                                    </div><!-- /.title -->

                                    <div class="price">
                                        1 250 000€
                                    </div><!-- /.price -->
                                </div><!-- /.title -->

                                <div class="location">Palo Alto CA</div><!-- /.location -->
                                <p>Etiam at ante id enim dictum posuere id vel est. Praesent at massa quis risus cursus tristique vel non orci. Phasellus ut nisi non odio</p>
                                <div class="area">
                                    <span class="key">Area:</span><!-- /.key -->
                                    <span class="value">120</span><!-- /.value -->
                                </div><!-- /.area -->
                                <div class="bedrooms"><div class="content">4</div></div><!-- /.bedrooms -->
                                <div class="bathrooms"><div class="content">3</div></div><!-- /.bathrooms -->
                            </div><!-- /.body -->
                        </div><!-- /.property -->
                    </div><!-- /.row -->

                    <div class="property span9">
                        <div class="row">
                            <div class="image span3">
                                <div class="content">
                                    <a href="detail.html"></a>
                                    <img src="/img/tmp/property-small-3.png" alt="">
                                </div><!-- /.content -->
                            </div><!-- /.image -->

                            <div class="body span6">
                                <div class="title-price row">
                                    <div class="title span4">
                                        <h2><a href="detail.html">27523 Pacific Coast</a></h2>
                                    </div><!-- /.title -->

                                    <div class="price">
                                        1 250 000€
                                    </div><!-- /.price -->
                                </div><!-- /.title -->

                                <div class="location">Palo Alto CA</div><!-- /.location -->
                                <p>Etiam at ante id enim dictum posuere id vel est. Praesent at massa quis risus cursus tristique vel non orci. Phasellus ut nisi non odio</p>
                                <div class="area">
                                    <span class="key">Area:</span><!-- /.key -->
                                    <span class="value">120</span><!-- /.value -->
                                </div><!-- /.area -->
                                <div class="bedrooms"><div class="content">4</div></div><!-- /.bedrooms -->
                                <div class="bathrooms"><div class="content">3</div></div><!-- /.bathrooms -->
                            </div><!-- /.body -->
                        </div><!-- /.property -->
                    </div><!-- /.row -->


                    <div class="property span9">
                        <div class="row">
                            <div class="image span3">
                                <div class="content">
                                    <a href="detail.html"></a>
                                    <img src="/img/tmp/property-small-4.png" alt="">
                                </div><!-- /.content -->
                            </div><!-- /.image -->

                            <div class="body span6">
                                <div class="title-price row">
                                    <div class="title span4">
                                        <h2><a href="detail.html">27523 Pacific Coast</a></h2>
                                    </div><!-- /.title -->

                                    <div class="price">
                                        1 250 000€
                                    </div><!-- /.price -->
                                </div><!-- /.title -->

                                <div class="location">Palo Alto CA</div><!-- /.location -->
                                <p>Etiam at ante id enim dictum posuere id vel est. Praesent at massa quis risus cursus tristique vel non orci. Phasellus ut nisi non odio</p>
                                <div class="area">
                                    <span class="key">Area:</span><!-- /.key -->
                                    <span class="value">120</span><!-- /.value -->
                                </div><!-- /.area -->
                                <div class="bedrooms"><div class="content">4</div></div><!-- /.bedrooms -->
                                <div class="bathrooms"><div class="content">3</div></div><!-- /.bathrooms -->
                            </div><!-- /.body -->
                        </div><!-- /.property -->
                    </div><!-- /.row -->
                </div><!-- /.row -->
            </div><!-- /.properties-rows -->
            <div class="pagination pagination-centered">
                <ul>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li class="active"><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">next</a></li>
                    <li><a href="#">last</a></li>
                </ul>
            </div><!-- /.pagination -->
        </div>
        
        <?php $this->renderPartial('/partials/_rightSidebar'); ?>
    </div>
</div>