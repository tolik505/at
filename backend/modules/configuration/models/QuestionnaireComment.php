<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class QuestionnaireComment
 */
class QuestionnaireComment extends ConfigurationModel
{
    public static $title = 'A commentary to the Application Form';
    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'questionnaire_comment_subject',
            'questionnaire_comment_body',
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
        return ['/configuration/questionnaire-comment/update'];
    }
}
