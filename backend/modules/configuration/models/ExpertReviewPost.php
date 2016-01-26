<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class ExpertReviewPost
 */
class ExpertReviewPost extends ConfigurationModel
{
    public static $title = 'Expert has sent his expert opinion';

    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'questionnaire_review_posted_emails',
            'questionnaire_review_posted_subject',
            'questionnaire_review_posted_body',
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
        return ['/configuration/expert-review-post/update'];
    }
}
