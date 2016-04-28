<?php

use app\modules\request\models\Request;

?>


<header style="background-image: url(/img/content/bg.png)">
    <div class="wrap">
        <div class="header_top">
            <img src="/img/content/logo.png" alt="" class="logo">
            <button class="btn_header ajax-link btn--js" href="<?= Request::getRequestMailUsUrl() ?>"><span class="btn_text"><?= \Yii::t('front_static', 'Contact us') ?></span></button>
        </div>
        <div class="header_bottom">
            <p class="title"><?= \Yii::t('front_static', 'A form worth the content') ?></p>
            <p class="header_text">
                <?= \Yii::t('front_static', 'RETAL INDUSTRIES manufacturers  polyethylene terephthalate (PET) for  packaging industry. We offer a full range of services, with professional expertise for every stage of product manufacturing.') ?>
            </p>
        </div>
        <div class="mouse_block">
            <div class="mouse">
                <span></span>
            </div>
        </div>
    </div>
</header>

<div class="wrap">
    <div class="headline">
        <h2 class="headline__title">
            <?= \Yii::t('front_static', 'What we do') ?>
        </h2>
        <!--right text-->
        <div class="headline__info">
            <p class="headline__info-title">
                <?= \Yii::t('front_static', 'Preforms') ?>
            </p>
            <p class="headline__info-text">
                <?= \Yii::t('front_static', 'We produce PET preforms in a wide variety of colours, designs and modifications, made by employing the
                latest manufacturing technologies. Let our experience work for uniqueness of your product') ?>
            </p>
        </div>
        <h1 class="headline__main-title">
            <?= \Yii::t('front_static', 'preforms') ?>
        </h1>
        <img src="/img/content/plastic_1.png" alt="" class="headline__img-left">
        <img src="/img/content/plastic_2.png" alt="" class="headline__img-right">
    </div>

</div>

<div class="main_conumn wrap">
    <div class="product">
        <ul class="product-cell">
            <li class="product-cell__item">
                <div class="prod_inside prod--left">
                    <p class="prod_title"><?= \Yii::t('front_static', 'closures') ?></p>
                    <p class="prod_text">
                        <?= \Yii::t('front_static', 'A variety of sizes, colours and laser decoration options for bottle closures, that allow PET cap speaks for itself.') ?>
                    </p>
                </div>
            </li>
            <li class="product-cell__item">
                <div class="prod_block">
                    <div class="prod_bg">
                        <img src="/img/content/img_1.png" alt="" class="prod_img">
                    </div>
                </div>
            </li>
            <li class="product-cell__item">
                <div class="prod_block">
                    <div class="prod_bg">
                        <img src="/img/content/img_2.png" alt="" class="prod_img">
                    </div>
                </div>
            </li>
            <li class="product-cell__item">
                <div class="prod_inside prod--right">
                    <p class="prod_title"><?= \Yii::t('front_static', 'closures') ?></p>
                    <p class="prod_text">
                        <?= \Yii::t('front_static', 'A variety of sizes, colours and laser decoration options for bottle closures, that allow PET cap speaks for itself.') ?>
                    </p>
                </div>
            </li>
            <li class="product-cell__item">
                <div class="prod_inside prod--left">
                    <p class="prod_title"><?= \Yii::t('front_static', 'closures') ?></p>
                    <p class="prod_text">
                        <?= \Yii::t('front_static', 'A variety of sizes, colours and laser decoration options for bottle closures, that allow PET cap speaks for itself.') ?>
                    </p>
                </div>
            </li>
            <li class="product-cell__item">
                <div class="prod_block">
                    <div class="prod_bg">
                        <img src="/img/content/img_3.png" alt="" class="prod_img">
                    </div>
                </div>
            </li>
            <li class="product-cell__item">
                <div class="prod_block">
                    <div class="prod_bg">
                        <img src="/img/content/img_4.png" alt="" class="prod_img">
                    </div>
                </div>
            </li>
            <li class="product-cell__item">
                <div class="prod_inside prod--right">
                    <p class="prod_title">closures</p>
                    <p class="prod_text">
                        <?= \Yii::t('front_static', 'A variety of sizes, colours and laser decoration options for bottle closures, that allow PET cap speaks for itself.') ?>
                    </p>
                </div>
            </li>
            <li class="product-cell__item">
                <div class="prod_inside prod--left">
                    <p class="prod_title"><?= \Yii::t('front_static', 'closures') ?></p>
                    <p class="prod_text">
                        <?= \Yii::t('front_static', 'A variety of sizes, colours and laser decoration options for bottle closures, that allow PET cap speaks for itself.') ?>
                    </p>
                </div>
            </li>
            <li class="product-cell__item">
                <div class="prod_block">
                    <div class="prod_bg">
                        <img src="/img/content/img_5.png" alt="" class="prod_img">
                    </div>
                </div>
            </li>
            <li class="product-cell__item">
                <div class="prod_block">
                    <div class="prod_bg">
                        <img src="/img/content/img_6.png" alt="" class="prod_img">
                    </div>
                </div>
            </li>
            <li class="product-cell__item">
                <div class="prod_inside prod--left">
                    <p class="prod_title"><?= \Yii::t('front_static', 'closures') ?></p>
                    <p class="prod_text">
                       <?= \Yii::t('front_static', ' A variety of sizes, colours and laser decoration options for bottle closures, that allow PET cap speaks for itself.') ?>
                    </p>
                </div>
            </li>

        </ul>
    </div>
    <div class="fix_block">
        <div class="fix_content">
            <p class="fix_title">
                <?= \Yii::t('front_static', 'R&d') ?>
            </p>
            <p class="fix_text fix_tex--first">
                <?= \Yii::t('front_static', 'RETAL offer a wide range of services required for the development of PET-products. Our qualified R&D team provides innovative solutions in creation of design and development of PET-preforms, bottles, closures, and films. We take your needs and convert them into efficient solutions.') ?>
            </p>
            <p class="fix_title">
                <?= \Yii::t('front_static', 'service') ?>
            </p>
            <p class="fix_text">
               <?= \Yii::t('front_static', 'With a team of professionals on staff. We are dedicated to giving you expert assistance. RETAL offers a first-rate client support services: business solution development, product design development,  industrial validation, lab validation, delivery…
                qui officia deserunt mollit anim id est laborum') ?>
            </p>
            <button class="fix-btn contact-js ajax-link" href="<?= Request::getRequestMailUsUrl() ?>"><span class="fix-btn_text">Contact us</span></button>

        </div>
    </div>
</div>

<div class="map">
    <div class="wrap">
        <p class="title title--map"><?= \Yii::t('front_static', 'geographic') ?></p>
    </div>

</div>

<div class="wrap">
    <div class="social_block1 ">
        <ul class="social-cell">
            <li class="social-cell__item">
                <div class="social_block">
                    <div class="social_bg">
                        <img src="/img/content/img_big_1.png" alt="" class="social_img">
                    </div>
                </div>
            </li>
            <li class="social-cell__item">
                <div class="social_inside">
                    <p class="title social_title">
                        <?= \Yii::t('front_static', 'SOCIAL RESPONSIBILITY') ?>
                    </p>
                    <p class="social_text">
                        <?= \Yii::t('front_static', 'We have the moral obligation to contribute to the protection of the environment.  We believe it is essential not only to take care of our customers, but also to respect and improve the world we live in. RETAL takes part in “Green Office”  campaign.') ?>
                    </p>
                </div>
            </li>
            <li class="social-cell__item">
                <div class="social_inside">
                    <p class="title social_title">
                        <?= \Yii::t('front_static', 'SOCIAL RESPONSIBILITY') ?>
                    </p>
                    <p class="social_text">
                        <?= \Yii::t('front_static', 'We have the moral obligation to contribute to the protection of the environment.  We believe it is essential not only to take care of our customers, but also to respect and improve the world we live in. RETAL takes part in “Green Office”  campaign.') ?>
                    </p>
                </div>
            </li>
            <li class="social-cell__item">
                <div class="social_block">
                    <div class="social_bg">
                        <img src="/img/content/img_big2.png" alt="" class="social_img">
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<div class="get_in_touch">
    <div class="get_wrap wrap">
        <p class="title title--get"><?= \Yii::t('front_static', 'Get in touch') ?></p>
        <p class="get_text">
            <?= \Yii::t('front_static', 'Contact a RETAL INDUSTRIES representative to get more information about our products and services.') ?>
        </p>
        <button class="get_btn ajax-link" href="<?= Request::getRequestMailUsUrl() ?>"><span class="btn_get_text"><?= \Yii::t('front_static', 'Contact us') ?></span></button>
    </div>
</div>

<footer>
    <div class="wrap">
        <div class="footer_inside">
            <img src="/img/content/logo.png" alt="" class="footer_logo">
            <p class="question"><?= \Yii::t('front_static', 'Have a question?') ?></p>
            <p class="tel"><?= \Yii::t('front_static', '+357 (25) 2700 500') ?></p>
            <p class="copyright"><?= \Yii::t('front_static', 'Copyright © 2016 Retal Industries LTD. All Rights Reserved.') ?></p>
            <p class="vintage">
                <span class="by"><?= \Yii::t('front_static', 'by') ?></span>
                <a href="vintage.com.ua" target="_blank" class="footer_link_vintage">
<!--                    --><?//xml version="1.0" encoding="utf-8"?>
                    <!-- Generator: Adobe Illustrator 19.2.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="70px" height="20px"
                         viewBox="0 0 551.2 118.7" enable-background="new 0 0 551.2 118.7" xml:space="preserve">
                        <g>
                            <polygon points="21.8,1.6 0,1.6 5.1,21.4 26.6,21.4 	"/>
                            <rect x="97.8" y="1.6" width="22.1" height="115.5"/>
                            <polygon points="197.4,70.1 197.1,70.1 166.4,1.6 142.2,1.6 142.2,117.1 162.4,117.1 162.4,42.6 162.7,42.6 196.5,117.1
                                217.6,117.1 217.6,1.6 197.4,1.6 	"/>
                            <polygon points="305.6,1.6 232,1.6 232,21.1 257.8,21.1 257.8,117.1 279.8,117.1 279.8,21.1 305.6,21.1 	"/>
                            <path d="M333.6,1.6L305,117.1h21.3l6.2-24.3H363l5.6,24.3h21.1L361.9,1.6L333.6,1.6L333.6,1.6z M336.5,73.3l10.9-46.7h0.3
                                l10.7,46.7L336.5,73.3L336.5,73.3z"/>
                            <path d="M436.3,19.5c8,0,13.4,4.8,13.4,19.7h22.1C471,13,458.9,0,436.3,0c-21.4,0-36.5,10.2-36.5,38.7V80c0,28.5,15,38.7,36.5,38.7
                                c8.3,0,14.7-4.5,20.6-11.2l3.4,9.6h11.5V57.9h-37.6v18.2h15.5v7c0,9.9-5.1,16-13.4,16c-8.8,0-14.4-3.5-14.4-16.3v-47
                                C421.9,23,427.5,19.5,436.3,19.5z"/>
                            <polygon points="512.8,97.6 512.8,67.2 542.1,67.2 542.1,47.7 512.8,47.7 512.8,21.1 551.2,21.1 551.2,1.6 490.7,1.6 490.7,117.1
                                552.8,117.1 552.8,97.6 	"/>
                            <polygon points="63.2,1.6 33.7,117.1 54.7,117.1 84.2,1.6 	"/>
                        </g>
                        </svg>
                </a>
            </p>
        </div>
    </div>

</footer>
