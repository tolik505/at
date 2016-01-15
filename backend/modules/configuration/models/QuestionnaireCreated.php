<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class QuestionnaireCreated
 */
class QuestionnaireCreated extends ConfigurationModel
{
    public static $title = 'A new Application Form has been created';

    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'questionnaire_created_emails',
            'questionnaire_created_subject',
            'questionnaire_created_body',
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
        return ['/configuration/questionnaire-created/update'];
    }
}
