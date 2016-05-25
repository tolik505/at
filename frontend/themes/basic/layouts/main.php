<?php
use frontend\assets\AppAsset;

/* @var $this \yii\web\View */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="<?= Yii::$app->language ?>" ng-app="app"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="<?= Yii::$app->language ?>" ng-app="app"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="<?= Yii::$app->charset ?>">
    <title>Chow</title>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script>paceOptions = {ajax: {trackMethods: ['GET', 'POST']}};</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/red/pace-theme-minimal.css" rel="stylesheet" />
<?php $this->head() ?>
</head>

<body>

<!-- Wrapper -->
<div id="wrapper">


    <!-- Header
    ================================================== -->
    <header id="header">

        <!-- Container -->
        <div class="container">

            <!-- Logo / Mobile Menu -->
            <div class="three columns">
                <div id="logo">
                    <h1><a href="index.html"><img src="images/logo.png" alt="Chow" /></a></h1>
                </div>
            </div>


            <!-- Navigation
            ================================================== -->
            <div class="thirteen columns navigation">

                <nav id="navigation" class="menu nav-collapse">
                    <ul>
                        <li><a href="index.html">Home</a></li>

                        <li><a href="browse-recipes.html#">Demos</a>
                            <ul>
                                <li><a href="index.html">Grid Homepage</a></li>
                                <li><a href="index-2.html">List Homepage</a></li>
                                <li><a href="index-3.html">Boxed Version</a></li>
                            </ul>
                        </li>

                        <li><a href="browse-recipes.html#" id="current">Recipes</a>
                            <ul>
                                <li><a href="browse-recipes.html">Browse Recipes</a></li>
                                <li><a href="recipe-page-1.html">Recipe Page #1</a></li>
                                <li><a href="recipe-page-2.html">Recipe Page #2</a></li>
                            </ul>
                        </li>

                        <li><a href="browse-recipes.html#">Pages</a>
                            <ul>
                                <li><a href="shortcodes.html">Shortcodes</a></li>
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </li>

                        <li><a href="browse-recipes.html#">Shop</a>
                            <ul>
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="product-page.html">Product Page</a></li>
                            </ul>
                        </li>

                        <li><a href="submit-recipe.html">Submit Recipe</a></li>
                    </ul>
                </nav>

            </div>

        </div>
        <!-- Container / End -->
    </header>
    
    <div ng-view></div>

</div>
<!-- Wrapper / End -->


<!-- Footer
================================================== -->
<div id="footer">

    <!-- Container -->
    <div class="container">

        <div class="five columns">
            <!-- Headline -->
            <h3 class="headline footer">About</h3>
            <span class="line"></span>
            <div class="clearfix"></div>
            <p>Cras at ultrices erat, sed vulputate eros. Nunc at augue gravida est fermentum vulputate. Pellentesque et ipsum in dui malesuada tempus.</p>
        </div>

        <div class="three columns">

            <!-- Headline -->
            <h3 class="headline footer">Archives</h3>
            <span class="line"></span>
            <div class="clearfix"></div>

            <ul class="footer-links">
                <li><a href="browse-recipes.html#">June 2014</a></li>
                <li><a href="browse-recipes.html#">July 2014</a></li>
                <li><a href="browse-recipes.html#">August 2014</a></li>
                <li><a href="browse-recipes.html#">September 2014</a></li>
                <li><a href="browse-recipes.html#">November 2014</a></li>
            </ul>

        </div>

        <div class="three columns">

            <!-- Headline -->
            <h3 class="headline footer">Recipes</h3>
            <span class="line"></span>
            <div class="clearfix"></div>

            <ul class="footer-links">
                <li><a href="browse-recipes.html">Browse Recipes</a></li>
                <li><a href="recipe-page-1.html">Recipe Page</a></li>
                <li><a href="submit-recipe.html">Submit Recipe</a></li>
            </ul>

        </div>

        <div class="five columns">

            <!-- Headline -->
            <h3 class="headline footer">Newsletter</h3>
            <span class="line"></span>
            <div class="clearfix"></div>
            <p>Sign up to receive email updates on new product announcements, gift ideas, sales and more.</p>

            <form action="browse-recipes.html#" method="get">
                <input class="newsletter" type="text" placeholder="mail@example.com" value=""/>
                <button class="newsletter-btn" type="submit">Subscribe</button>

            </form>
        </div>

    </div>
    <!-- Container / End -->

</div>
<!-- Footer / End -->

<!-- Footer Bottom / Start -->
<div id="footer-bottom">

    <!-- Container -->
    <div class="container">

        <div class="eight columns">© Copyright 2014 by <a href="browse-recipes.html#">Chow</a>. All Rights Reserved.</div>

    </div>
    <!-- Container / End -->

</div>
<!-- Footer Bottom / End -->

<!-- Back To Top Button -->
<div id="backtotop"><a href="browse-recipes.html#"></a></div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
