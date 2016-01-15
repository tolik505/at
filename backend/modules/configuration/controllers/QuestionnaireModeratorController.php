<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\controllers;

use backend\modules\configuration\components\ConfigurationController;
use backend\modules\configuration\models\QuestionnaireModerator;

/**
 * Class QuestionnaireModeratorController
 */
class QuestionnaireModeratorController extends ConfigurationController
{
    /**
     * Have to return Model::className()
     *
     * @inheritdoc
     */
    public function getModelClass()
    {
        return QuestionnaireModerator::className();
    }
}
