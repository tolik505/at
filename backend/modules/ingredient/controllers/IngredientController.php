<?php

namespace backend\modules\ingredient\controllers;

use backend\components\BackendController;
use backend\modules\ingredient\models\Ingredient;

/**
 * IngredientController implements the CRUD actions for Ingredient model.
 */
class IngredientController extends BackendController
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Ingredient::className();
    }
}
