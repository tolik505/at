<?php

namespace backend\modules\request\controllers;

use backend\components\BackendController;
use backend\modules\request\models\Request;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends BackendController
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Request::className();
    }
}
