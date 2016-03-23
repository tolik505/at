<?php
/**
 * @author walter
 */

namespace frontend\components;


use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;

class FrontendController extends Controller
{

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $url = \Yii::$app->request->getAbsoluteUrl();

            preg_match("/(http|https):\/\/(www.)*/", $url, $match);

            if (count($match)) {
                if (ArrayHelper::getValue($match, 2) == 'www.') {
                    $url = str_replace('www.', '', $url);

                    return $this->redirect($url, 301);
                }
            }

            $this->view->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
            return true;
        } else {
            return false;
        }
    }

} 
