<?php
/**
 * Author: Pavel Naumenko
 */

namespace backend\modules\menu\widgets;

use common\models\User;
use kartik\nav\NavX;
use Yii;

/**
 * Class RightBarMenu
 * @package backend\modules\menu\widgets
 */
class RightBarMenu extends NavX
{
    /** @var array */
    public $options = ['class' => 'navbar-nav navbar-right'];

    /**
     * @inheritdoc
     */
    public $dropdownIndicator = '<span class="caret-dot"></span>';

    /**
     * @inheritdoc
     */
    public $activateParents = true;

    public function init()
    {
        parent::init();

        $items = [];
        if (Yii::$app->user->can(User::ROLE_ADMIN)) {
            $userName = Yii::$app->user->identity->username;
            $items = [
                [
                    'label' => $userName,
                    'items' => Yii::$app->params['rightBarMenuItems']
                ]
            ];
        }

        $this->items = $items;
    }
}
