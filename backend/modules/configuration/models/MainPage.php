<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class MainPage
 *
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
     * @return array
     */
    public function getFormTypes()
    {
        return [
            'main_page_header_title' => Configuration::TYPE_STRING,
            'main_page_header_content' => Configuration::TYPE_HTML,
            'main_page_header_link' => Configuration::TYPE_STRING,

            'main_page_header_show_new_projects' => Configuration::TYPE_FILE,
            'main_page_header_show_popular_projects' => Configuration::TYPE_BOOLEAN,
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
