<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\menu\widgets;

use backend\modules\configuration\models\FeedbackPage;
use backend\modules\configuration\models\MainPage;
use backend\modules\configuration\models\ResultPage;
use common\models\User;
use notgosu\yii2\modules\metaTag\Module;
use Yii;
use yii\bootstrap\Nav;

/**
 * Class MainMenu
 * @package backend\modules\menu\widgets
 */
class MainMenu extends Nav
{
    public $options = ['class' => 'navbar-nav'];

    public function init()
    {
        parent::init();

        $items = [
            ['label' => 'Home', 'url' => ['/site/index']],
        ];
        if (Yii::$app->user->can(User::ROLE_ADMIN)) {
            $items[] = [
                'label' => 'Configuration',
                'url' => ['/configuration/default/index'],
                'items' => [
                    [
                        'label' => 'Configuration',
                        'url' => ['/configuration/default/index'],
                    ],
                    [
                        'label' => 'Translations',
                        'url' => ['/i18n/default/index'],
                    ],
                    [
                        'label' => 'Seo Tags',
                        'url' => ['/meta/tag/index'],
                    ],
                    [
                        'label' => 'Robots.txt',
                        'url' => ['/seo/robots/index'],
                    ],
                    [
                        'label' => 'Language',
                        'url' => ['/language/language/index'],
                    ],
                    [
                        'label' => 'Redirects',
                        'url' => ['/redirects/redirects/index'],
                    ],
                ],
            ];
        }

        $this->items = $items;
    }
}
