<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class ReleaseWidget
 * @package backend\modules\configuration\models
 */
class ReleaseWidget extends ConfigurationModel
{
    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'release_start_date_time',
            'release_finish_date_time',
            'release_is_started',
        ];
    }

    /**
     * Title of the form
     *
     * @return string
     */
    public function getTitle()
    {
        return \Yii::t('app', 'Release widget');
    }

    /**
     * @return array
     */
    public static function getUpdateUrl()
    {
        return ['/configuration/release/update'];
    }
}
