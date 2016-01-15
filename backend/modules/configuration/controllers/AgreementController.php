<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\controllers;

use backend\modules\configuration\components\ConfigurationController;
use backend\modules\configuration\models\Agreement;
use backend\modules\configuration\models\MainPage;

/**
 * Class AgreementController
 * @package backend\modules\configuration\controllers
 */
class AgreementController extends ConfigurationController
{
    /**
     * Have to return Model::className()
     *
     * @inheritdoc
     */
    public function getModelClass()
    {
        return Agreement::className();
    }
}
