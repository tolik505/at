<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\controllers;

use backend\modules\configuration\components\ConfigurationController;
use backend\modules\configuration\models\FeedbackPage;

/**
 * Class FeedbackPageController
 * @package backend\modules\configuration\controllers
 */
class FeedbackPageController extends ConfigurationController
{
    /**
     * Have to return Model::className()
     *
     * @inheritdoc
     */
    public function getModelClass()
    {
        return FeedbackPage::className();
    }
}
