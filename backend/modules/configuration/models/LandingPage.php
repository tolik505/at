<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class LandingPage
 */
class LandingPage extends ConfigurationModel
{
    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'landing_video_code',
            'landing_pagination',
            'landing_main_block',
        ];
    }

    /**
     * Title of the form
     *
     * @return string
     */
    public function getTitle()
    {
        return \Yii::t('app', 'Landing Page');
    }

    /**
     * @return array
     */
    public static function getUpdateUrl()
    {
        return ['/configuration/landing-page/update'];
    }
}
