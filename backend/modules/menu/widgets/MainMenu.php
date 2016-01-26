<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\menu\widgets;

use common\models\User;
use kartik\nav\NavX;
use Yii;

/**
 * Class MainMenu
 * @package backend\modules\menu\widgets
 */
class MainMenu extends NavX
{
    /** @var array */
    public $options = ['class' => 'navbar-nav navbar-left no-active-background'];

    /**
     * @inheritdoc
     */
    public $activateParents = true;

    public function init()
    {
        parent::init();

        $items = [];
        if (Yii::$app->user->can(User::ROLE_ADMIN)) {
            $items = Yii::$app->params['menuItems'];
        }

        $this->items = $items;
    }
}
