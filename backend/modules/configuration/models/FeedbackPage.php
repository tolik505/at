<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\models;

use backend\modules\configuration\components\ConfigurationModel;

/**
 * Class FeedbackPage
 * @package backend\modules\configuration\models
 */
class FeedbackPage extends ConfigurationModel
{
    /**
     * Array of configuration keys to manage on form
     *
     * @return array
     */
    public function getKeys()
    {
        return [
            'feedback_page_email',
            'feedback_page_widget',
        ];
    }

    /**
     * Title of the form
     *
     * @return string
     */
    public function getTitle()
    {
        return \Yii::t('app', 'Feedback page');
    }

    /**
     * @return array
     */
    public static function getUpdateUrl()
    {
        return ['/configuration/feedback-page/update'];
    }
}
