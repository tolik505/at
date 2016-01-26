<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\controllers;

use backend\modules\configuration\components\ConfigurationController;
use backend\modules\configuration\models\EmailConfirmation;
use backend\modules\configuration\models\Sample;
use backend\modules\configuration\models\QuestionnaireComment;
use backend\modules\configuration\models\QuestionnaireCreated;

/**
 * Class SampleController
 */
class SampleController extends ConfigurationController
{
    /**
     * Have to return Model::className()
     *
     * @inheritdoc
     */
    public function getModelClass()
    {
        return Sample::className();
    }
}
