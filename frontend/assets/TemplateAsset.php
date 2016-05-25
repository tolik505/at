<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TemplateAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/colors/green.css',
    ];
    public $js = [
        'scripts/jquery-migrate-1.2.1.min.js',
        'scripts/jquery.superfish.js',
        'scripts/jquery.royalslider.min.js',
        'scripts/responsive-nav.js',
        'scripts/hoverIntent.js',
        'scripts/isotope.pkgd.min.js',
        'scripts/chosen.jquery.min.js',
        'scripts/jquery.tooltips.min.js',
        'scripts/jquery.magnific-popup.min.js',
        'scripts/jquery.pricefilter.js',
    ];
}
