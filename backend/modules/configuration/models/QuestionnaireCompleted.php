<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class QuestionnaireCompleted
 */
class QuestionnaireCompleted extends ConfigurationModel
{
    public static $title = 'Application Form has been fully сompleted';

    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'questionnaire_moderation_emails',
            'questionnaire_moderation_subject',
            'questionnaire_moderation_body',
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
        return ['/configuration/questionnaire-completed/update'];
    }
}
