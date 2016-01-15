<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class MainPage
 * @package backend\modules\configuration\models
 */
class MainPage extends ConfigurationModel
{
    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'main_page_header_title',
            'main_page_header_content',
            'main_page_header_link',

            'main_page_header_show_new_projects',
            'main_page_header_show_popular_projects',
        ];
    }

    /**
     * Title of the form
     *
     * @return string
     */
    public function getTitle()
    {
        return \Yii::t('app', 'Main page');
    }

    /**
     * @return array
     */
    public static function getUpdateUrl()
    {
        return ['/configuration/main-page/update'];
    }
}
