<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class ResultPage
 * @package backend\modules\configuration\models
 */
class ResultPage extends ConfigurationModel
{
    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'result_page_block1_title',
            'result_page_block1_number',

            'result_page_block2_title',
            'result_page_block2_number',

            'result_page_block3_title',
            'result_page_block3_number',

            'result_page_block4_title',
            'result_page_block4_number',

            'result_page_content',
        ];
    }

    /**
     * Title of the form
     *
     * @return string
     */
    public function getTitle()
    {
        return \Yii::t('app', 'Results page');
    }

    /**
     * @return array
     */
    public static function getUpdateUrl()
    {
        return ['/configuration/result-page/update'];
    }
}
