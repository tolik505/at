<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class QuestionnaireApprove
 */
class QuestionnaireApprove extends ConfigurationModel
{
    public static $title = 'Having reviewed the Application Form and the Expert\'s opinion, Moderator has granted the access to create a Project';

    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'questionnaire_approved_subject',
            'questionnaire_approved_body',
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
        return ['/configuration/questionnaire-approve/update'];
    }
}
