<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>jQuery filter.me &raquo; Filter your images via Photoshop Curves</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="responsive.css">

        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/html5.js"><\/script>')</script>
        <![endif]-->

    </head>
    <body id="home">

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="#home">Home</a></li>
                            <li><a href="#usage">Usage</a></li>
                            <li><a href="#resources">Resources</a></li>
                            <li><a href="#about">About</a></li>
                        </ul>
                </div>
            </div>
        </nav>

        <div class="container">

            <header class="page-header">
                <h1 class="page-title">jQuery filter.me</h1>
                <h2 class="h3">Filter your images using Canvas, Photoshop Curves &amp; jDataView.</h2>
                <hr>
                <p>jQuery filter.me is a jQuery dependant script that allows you to apply filters to images using Photoshop .acv Curves Adjustment files. jDataView is used to read the Photoshop file, from which we create a Monotonic Spline Curve representing its data. From this curve the new pixel RGB values can be calculated. These values are then applied using HTML5's canvas element.</p>
                <p>Literally any Photoshop curves file can be applied to multiple images with ease. This is a great alternative to using something like PHP's imagemagick to try and replicate similar filtering. It can sometimes be a little slow, especially in mobile browsers, but I'm sure this will improve as canvas becomes more mainstream.
            </header>

            <!-- Examples -->
            <section class="row-fluid images">
                <?php
                    // The image
                    $image = 'img/photo.jpg';
                    // Pathinfo
                    $pathinfo = pathinfo( $image );
                    $filename = $pathinfo['filename'];
                ?>

                <!-- Original -->
                <div class="pull-left image">
                    <div class="caption">
                        <span style="top: 6px;">Original</span>
                    </div>
                    <img src="<?php echo $image; ?>" class="filter" width="306" height="306" />
                </div>

                <!-- Filtered Images -->
                <?php
                    // Let's create an array to demonstrate each filter
                    $filters = array( '1977', 'Brannan', 'Gotham', 'Hefe', 'Inkwell', 'Lord Kelvin', 'Nashville', 'X-PRO II' );
                    foreach ( $filters as $filter ) {
                        ?>
                        <div class="pull-left image preload">
                            <div class="caption">
                                <span><?php echo $filter; ?></span>
                                <form method="post" action="export.php" enctype="multipart/form-data">
                                    <input type="hidden" name="data" class="js-data" value="" />
                                    <input type="hidden" name="filename" value="<?php echo $filename; ?>" />
                                    <input type="hidden" name="filter" value="<?php echo $filter; ?>" />
                                    <input type="submit" name="save" class="btn" value="Download" />
                                </form>
                            </div>
                            <img src="<?php echo $image; ?>" class="filter" width="306" height="306" data-filter="<?php echo $filter; ?>" />
                        </div>
                        <?php
                    }
                ?>
            </section>

            <!-- Usage -->
            <div id="usage"></div><hr>
            <section class="row-fluid">
                <h3 class="h2">Usage</h3>

                <h4>Versions available</h4>
                <p>Two versions are available, so have a look below.</p>
                <p>
                    <ul class="info-list">
                        <li><b>Production</b> - This version doesn't read the curves files, and only contains one script. Instead, the RGB values for each filter have been hardcoded into the script, speeding things up but preventing you from using your own curves (.acv) files. Requires only <b>jquery.filterme.js</b>.</li>
                        <li><b>Development</b> - Contains all of the scripts, reading the curves (.acv) files each time the page is loaded. This takes a little longer (more files to load), but allows you to apply your own new filters easily (no need to calculate RGB values). This is where the real magic happens. Requires <b>jDataview.js</b>, <b>jspline.js</b> and <b>jquery.filterme.js</b>.</li>
                    </ul>
                </p>
                <br />

                <h4>Applying a filter</h4>
                <p>Adding the filters is easy. As normal, you'll have to load the scripts (and jQuery) into your site's <code>&#60;head&#62;</code> or in the footer before the <code>&#60;/body&#62;</code>. To intiate the filters, use the script below:</p>
                <p><pre><code>&#60;script type="text/javascript"&#62;
jQuery(document).ready(function($) {
    $('.filter').filterme();
});
&#60;/script&#62;</code></pre></p>
                <p>Then we add the filter class to the image, alongside the filter data attribute.</p>
                <p><pre><code>&#60;img src="photo.jpg" class="filter" data-filter="Nashville" /&#62;</code></pre></p>
                <p>And that's it. It should work immediately!</p>
                <br />

                <h4>Additional Options</h4>
                <p>Below are the options you can set when initiating the plugin.</p>
                <p><pre><code>$('.filter').filterme({
    desaturate: false   // Value from 0 - 1. 1 equals full desaturation (black & white).
    curves: false       // Object of RGB values in production script, or string name of curves .acv file in development script.
    vignette: false     // 'true' or 'false'. Add a vignette to the image.
    folder: 'acv/'      // Development script only. Location of the .acv folder, relative to the current file.
    debug: false        // Set to 'true' for script debugging. Logs information along execution in console.
});</code></pre></p>
            </section>

            <!-- Resources -->
            <div id="resources"></div><hr>
            <section class="row-fluid">
                <h3 class="h2">Resources</h3>
                <p>Just some of the resources I've used to create jQuery filter.me. Wouldn't be possible without the great work of others!</p>
                <ul class="info-list">
                    <li><b>jQuery</b> - <a href="http://jquery.com">http://jquery.com</a></li>
                    <li><b>jDataview</b> - <a href="http://github.com/vjeux/jDataView">http://github.com/vjeux/jDataView</a></li>
                    <li><b>Monotonic Spline Curves</b> - <a href="http://blog.mackerron.com/2011/01/01/javascript-cubic-splines/">http://blog.mackerron.com/2011/01/01/javascript-cubic-splines/</a></li>
                    <li><b>Instagram-like Photoshop Curves files</b> - <a href="http://www.doobybrain.com/2012/08/06/instagram-filters-for-photoshop/">http://www.doobybrain.com/2012/08/06/instagram-filters-for-photoshop/</a></li>
                </ul>
            </section>

            <!-- About Me -->
            <div id="about"></div><hr>
            <section>
                <h3 class="h2">Little about me</h3>
                <div class="row-fluid" style="margin-top: 20px;">
                    <div class="span2" style="margin-top: 5px;">
                        <a href="http://matthewruddy.com/" class="avatar" target="_blank">
                            <img src="img/profile.jpg" width="125" height="125" class="img-circle" />
                        </a>
                    </div>
                    <div class="span10">
                        <p>I'm a 19 year old aspiring entrepeneur and web developer based in Dublin, Ireland. Having decided to turn down university in the Ireland &amp; the UK, I've set out to pursue startup success and make great connections. Love creating things with emerging web technologies, just for the pure challenge of it!</p>
                        <p>Currently I'm working hard with my first major venture, Riva Slider, which has proven very successful so far. I also hope to create more awesome tools in the future, and to prove that there is a life outside of third level education for young tech entrepeneurs here in Ireland. <b>Please follow me and Riva Slider on Twitter!</b> Feel free to fire any questions my way, I'd be happy to answer them.</p>
                        <p style="margin-top: 20px;">
                            <span style="margin-right: 10px;"><a href="https://twitter.com/matthewruddycom" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @matthewruddycom</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></span>
                            <a href="https://twitter.com/rivaslider" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @rivaslider</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                        </p>
                    </div>
                </div>
            </section>

            <footer>

                <!-- Copyright -->
                <hr>
                <div class="copyright">Released under GNU general public license by <a href="http://matthewruddy.com" target="_blank">Matthew Ruddy</a>.</div>

                <!-- Javascripts -->
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

                <!-- Development Scripts
                <script src="js/development/jdataview.js"></script>
                <script src="js/development/jspline.js"></script>
                <script src="js/development/jquery.filterme.js"></script>
                -->

                <!-- Production Scripts -->
                <script src="js/production/jquery.filterme.js"></script>

                <!-- Load the plugin objects -->
                <script type="text/javascript">
                    jQuery(document).ready(function($) {

                        /*
                         * Hook our filter class
                         */
                        $('.filter').filterMe();

                        /*
                         * Additional functionality for sites demonstration
                         */
                        $('.filter').each(function() {

                            var $self = $(this),
                                $parent = $self.parent();
                                $data = $self.data('filterMe');

                            $data.$el.bind('filterMe.processEnd', function(event, base) {

                                // Remove preload class
                                $parent.removeClass('preload');

                                // Add image to URL hidden input
                                $parent.find('.js-data').val( base.url );

                            });
                        });

                    });
                </script>

            </footer>

        </div>

    </body>
</html>
