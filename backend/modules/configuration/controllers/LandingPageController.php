<?php
/**
 * Author: metal
 * Email: metal
 */

namespace backend\modules\configuration\controllers;

use backend\modules\configuration\components\ConfigurationController;
use backend\modules\configuration\models\LandingPage;
use backend\modules\configuration\models\MainPage;

/**
 * Class LandingPageController
 */
class LandingPageController extends ConfigurationController
{
    /**
     * Have to return Model::className()
     *
     * @inheritdoc
     */
    public function getModelClass()
    {
        return LandingPage::className();
    }
}
