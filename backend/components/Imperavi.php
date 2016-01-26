<?php
/**
 * Created by PhpStorm.
 * User: metal
 * Date: 02.10.15
 * Time: 14:53
 */

namespace backend\components;

use vova07\imperavi\Widget;
use yii\helpers\Url;

/**
 * Class Imperavi
 */
class Imperavi extends Widget
{
    public $settings = [
        'replaceDivs' => false,
        'buttons' => [
            'html',
            'formatting',
            'bold',
            'italic',
            'deleted',
            'unorderedlist',
            'orderedlist',
            'outdent',
            'indent',
            'image',
            'file',
            'link',
            'alignment',
            'horizontalrule',
        ],
        'plugins' => [
            'video',
        ],
    ];
    public function init()
    {
        if (!isset($this->settings['imageUpload'])) {
            $this->settings['imageUpload'] = Url::to(['image-upload']);
        }
        if (!isset($this->settings['fileUpload'])) {
            $this->settings['fileUpload'] = Url::to(['file-upload']);
        }

        parent::init();
    }

}
