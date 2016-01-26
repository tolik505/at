<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/select2_v3.4.3.css',
        'css/jquery.mCustomScrollbar.min_v2.8.1.css',
        'css/new_admin.css',
        'css/new_admin_for_user.css',
        'http://fonts.googleapis.com/css?family=Roboto:400,300&subset=latin,cyrillic',
        'http://fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,cyrillic',
        'css/site.css'
    ];
    public $js = [
        'js/jquery.li-translit.js',
        'js/jquery.mCustomScrollbar.min_v2.8.1.js',
        'js/select2.min__v3.4.3.js',
        'js/new_admin.js',
        'js/backend.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\JuiAsset'
    ];
}
