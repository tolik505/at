<?php
/**
 * Created by PhpStorm.
 * User: metal
 * Date: 27.04.15
 * Time: 15:33
 */

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Class Base
 * @package common\assets
 */
class Base extends AssetBundle
{
    public $sourcePath = '@common/assets';
    public $js = [
        'js/common.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
