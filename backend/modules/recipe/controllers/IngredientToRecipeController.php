<?php

namespace backend\modules\recipe\controllers;

use backend\components\BackendController;
use backend\modules\recipe\models\IngredientToRecipe;

/**
 * IngredientToRecipeController implements the CRUD actions for IngredientToRecipe model.
 */
class IngredientToRecipeController extends BackendController
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return IngredientToRecipe::className();
    }
}
