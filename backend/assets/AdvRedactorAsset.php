<?php
/**
 * Author: hanterrian
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Class AdvRedactorAsset
 *
 * @package backend\assets
 */
class AdvRedactorAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@backend/web';

    /**
     * @inheritdoc
     */
    public $css = [
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        '/js/adv.redactor.link.js'
    ];
}
