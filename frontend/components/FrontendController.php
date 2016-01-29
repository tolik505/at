<?php
/**
 * @author walter
 */

namespace frontend\components;


use yii\helpers\Url;
use yii\web\Controller;

class FrontendController extends Controller {

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $this->view->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
            return true;
        } else {
            return false;
        }
    }

} 