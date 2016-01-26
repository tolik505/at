<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\menu\widgets;

use kartik\nav\NavX;
use Yii;

/**
 * Class LoginMenu
 * @package backend\modules\menu\widgets
 */
class LoginMenu extends NavX
{
    public $options = ['class' => 'navbar-nav navbar-right'];

    public function init()
    {
        parent::init();

        $items = [];
        if (Yii::$app->user->isGuest) {
            $items[] = ['label' => 'Login', 'url' => ['/admin/default/login']];
        }

        $this->items = $items;
    }
}
