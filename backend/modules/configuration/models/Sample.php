<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class Sample
 */
class Sample extends ConfigurationModel
{
    public static $title = 'Sample title';

    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'email',
            'subject',
            'optional',
        ];
    }

    /**
     * Title of the form
     *
     * @return string
     */
    public function getTitle()
    {
        return self::$title;
    }

    /**
     * @return array
     */
    public function getFormTypes()
    {
        return [
            'email' => Configuration::TYPE_STRING,
            'subject' => Configuration::TYPE_HTML,
            'optional' => Configuration::TYPE_BOOLEAN,
        ];
    }

    /**
     * @return array
     */
    public function getUpdateUrl()
    {
        return ['/configuration/sample/update'];
    }
}
