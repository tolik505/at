<?php

namespace backend\modules\departmentOnMap\controllers;

use backend\components\BackendController;
use backend\modules\departmentOnMap\models\RegionsMapScale;

/**
 * RegionsMapScaleController implements the CRUD actions for RegionsMapScale model.
 */
class RegionsMapScaleController extends BackendController
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return RegionsMapScale::className();
    }
}
