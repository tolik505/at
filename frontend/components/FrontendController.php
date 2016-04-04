<?php
/**
 * @author walter
 */

namespace frontend\components;

use yii\web\Controller;

class FrontendController extends Controller
{

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            return true;
        } else {
            return false;
        }
    }

}