<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class ProjectToModeration
 */
class ProjectToModeration extends ConfigurationModel
{
    public static $title = 'User has submitted the project for review before launch';

    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'project_go_moderation_emails',
            'project_go_moderation_subject',
            'project_go_moderation_body',
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
        return ['/configuration/project-to-moderation/update'];
    }
}
