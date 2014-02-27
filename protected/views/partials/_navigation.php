<div id="navigation">
    <div class="container">
        <div class="navigation-wrapper">
            <div class="navigation clearfix-normal">

                <ul class="nav">
                    <li class="menuparent">
                        <span class="menuparent nolink">Homepage</span>
                        <ul>
                            <li><a href="index-slider.html">Homepage with slider</a></li>
                            <li><a href="index.html">Homepage with map</a></li>
                            <li><a href="index-simple.html">Simple homepage</a></li>
                            <li><a href="index-carousel.html">Homepage with carousel</a></li>
                        </ul>
                    </li>
                    <li class="menuparent">
                        <span class="menuparent nolink">Listing</span>
                        <ul>
                            <li><a href="listing-grid.html">Listing grid</a></li>
                            <li><a href="listing-grid-filter.html">Listing grid with filter</a></li>
                            <li><a href="listing-rows.html">Listing rows</a></li>
                            <li><a href="listing-rows-filter.html" >Listing rows with filter</a></li>
                        </ul>
                    </li>
                    <li class="menuparent">
                        <span class="menuparent nolink">Pages</span>
                        <ul>
                            <li><a href="about-us.html">About us</a></li>
                            <li><a href="our-agents.html">Our agents</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <li><a href="shortcodes.html">Shortcodes</a></li>
                            <li class="menuparent">
                                <span class="menuparent nolink">Another level</span>
                                <ul>
                                    <li><a href="contact-us.html">Contact us</a></li>
                                    <li><a href="grid-system.html">Grid system</a></li>
                                    <li><a href="typography.html">Typography</a></li>
                                </ul>
                            </li>
                            <li><a href="404.html">404 page</a></li>
                        </ul>
                    </li>
                    <li class="menuparent">
                        <span class="menuparent nolink">Pricing</span>
                        <ul>
                            <li><a href="pricing-boxed.html">Boxed pricing</a></li>
                            <li><a href="pricing-multiple.html">Multiple pricing</a></li>
                            <li><a href="pricing-simple.html">Simple Pricing</a></li>
                        </ul>
                    </li>
                    <li><a href="contact-us.html">Contact Us</a></li>
                    <?php if (Yii::app()->user->checkAccess('admin')): ?>
                    <li><a href="<?php echo Yii::app()->createUrl('/admin'); ?>"><?php echo 'Админпанель'; ?></a></li>
                    <?php endif; ?>
                </ul><!-- /.nav -->

                <?php $this->widget('application.components.widgets.LanguageSelector'); ?><!-- /.language-switcher -->

                <form method="get" class="site-search" action="?">
                    <div class="input-append">
                        <input title="Enter the terms you wish to search for." class="search-query span2 form-text" placeholder="Search" type="text" name="">
                        <button type="submit" class="btn"><i class="icon-search"></i></button>
                    </div><!-- /.input-append -->
                </form><!-- /.site-search -->
            </div><!-- /.navigation -->
        </div><!-- /.navigation-wrapper -->
    </div><!-- /.container -->
</div><!-- /.navigation -->