<?php
namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AngularAsset extends AssetBundle
{
    public $sourcePath = '@bower';
    public $css = [
        //'angular-material/angular-material.css',
    ];
    public $js = [
        'angular/angular.js',
        'angular-route/angular-route.js',
        'angular-strap/dist/angular-strap.js',
        /*'angular-animate/angular-animate.js',
        'angular-aria/angular-aria.js',
        'angular-messages/angular-messages.js',
        'angular-material/angular-material.js',*/
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}
