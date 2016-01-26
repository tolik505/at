<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\controllers;

use backend\modules\configuration\components\ConfigurationController;
use backend\modules\configuration\models\QuestionnaireComment;

/**
 * Class QuestionnaireCommentController
 */
class QuestionnaireCommentController extends ConfigurationController
{
    /**
     * Have to return Model::className()
     *
     * @inheritdoc
     */
    public function getModelClass()
    {
        return QuestionnaireComment::className();
    }
}
