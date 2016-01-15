<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class ProjectToPublish
 */
class ProjectToPublish extends ConfigurationModel
{
    public static $title = 'Moderator has published the Project after review';

    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'project_go_published_subject',
            'project_go_published_body',
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
        return ['/configuration/project-to-publish/update'];
    }
}
