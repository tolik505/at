<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class QuestionnaireExpert
 */
class Retrieve extends ConfigurationModel
{
    public static $title = 'When the User has requested password recovery';

    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'retrieve_email_subject',
            'retrieve_email_body',
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
    public static function getUpdateUrl()
    {
        return ['/configuration/retrieve/update'];
    }
}
