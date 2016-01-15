<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\controllers;

use backend\modules\configuration\components\ConfigurationController;
use backend\modules\configuration\models\ResultPage;

/**
 * Class ResultPageController
 * @package backend\modules\configuration\controllers
 */
class ResultPageController extends ConfigurationController
{
    /**
     * Have to return Model::className()
     *
     * @inheritdoc
     */
    public function getModelClass()
    {
        return ResultPage::className();
    }
}
