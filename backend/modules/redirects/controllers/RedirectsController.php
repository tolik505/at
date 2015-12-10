<?php

namespace backend\modules\redirects\controllers;

use backend\components\BackendController;
use backend\modules\redirects\models\Redirects;

/**
 * RedirectsController implements the CRUD actions for Redirects model.
 */
class RedirectsController extends BackendController
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Redirects::className();
    }

    public function actionEraseCache($id)
    {
        $model = $this->findModel($id);
        $model->clearCache();

        return $this->redirect(['index']);
    }
}
