<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class Agreement
 * @package backend\modules\configuration\models
 */
class Agreement extends ConfigurationModel
{
    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'user_agreement_file',
            'confidential_agreement_file',
        ];
    }

    /**
     * Title of the form
     *
     * @return string
     */
    public function getTitle()
    {
        return \Yii::t('app', 'Agreement files');
    }

    /**
     * @return array
     */
    public static function getUpdateUrl()
    {
        return ['/configuration/agreement/update'];
    }
}
