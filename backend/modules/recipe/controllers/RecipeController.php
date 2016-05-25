<?php

namespace backend\modules\recipe\controllers;

use backend\components\BackendController;
use backend\modules\recipe\models\Recipe;

/**
 * RecipeController implements the CRUD actions for Recipe model.
 */
class RecipeController extends BackendController
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Recipe::className();
    }
}
