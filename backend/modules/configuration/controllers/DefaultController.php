<?php

namespace backend\modules\configuration\controllers;

use backend\components\BackendController;
use Yii;
use backend\modules\configuration\models\Configuration;

/**
 * DefaultController implements the CRUD actions for Configuration model.
 */
class DefaultController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function getModelClass()
    {
        return Configuration::className();
    }
}
