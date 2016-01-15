<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\controllers;

use backend\modules\configuration\components\ConfigurationController;
use backend\modules\configuration\models\EmailConfirmation;
use backend\modules\configuration\models\QuestionnaireComment;

/**
 * Class EmailConfirmationController
 */
class EmailConfirmationController extends ConfigurationController
{
    /**
     * Have to return Model::className()
     *
     * @inheritdoc
     */
    public function getModelClass()
    {
        return EmailConfirmation::className();
    }
}
