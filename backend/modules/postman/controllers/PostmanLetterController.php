<?php

namespace backend\modules\postman\controllers;

use backend\components\BackendController;
use backend\modules\postman\models\PostmanLetter;

/**
 * PostmanLetterController implements the CRUD actions for PostmanLetter model.
 */
class PostmanLetterController extends BackendController
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return PostmanLetter::className();
    }

    public function actionDelete($id)
    {
        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        return $this->redirect(['index']);
    }

    public function actionCreate()
    {
        return $this->redirect(['index']);
    }

}
