<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\controllers;

use backend\modules\configuration\components\ConfigurationController;
use backend\modules\configuration\models\EmailConfirmation;
use backend\modules\configuration\models\QuestionnaireBlock;
use backend\modules\configuration\models\QuestionnaireComment;
use backend\modules\configuration\models\QuestionnaireCreated;

/**
 * Class QuestionnaireBlockController
 */
class QuestionnaireBlockController extends ConfigurationController
{
    /**
     * Have to return Model::className()
     *
     * @inheritdoc
     */
    public function getModelClass()
    {
        return QuestionnaireBlock::className();
    }
}
