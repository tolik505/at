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
            $baseUrl = \Yii::$app->request->getAbsoluteUrl();

            preg_match("/(http|https):\/\/(www.)*/", $baseUrl, $match);

            if (count($match)) {
                if (ArrayHelper::getValue($match, 2) == 'www.') {
                    $url = str_replace('www.', '', $baseUrl);

                    return $this->redirect($url, 301);
                }
            }

            $pos = strpos($baseUrl, '/index.php');
            
            if ($pos) {
                return $this->redirect(\Yii::$app->getHomeUrl());
            }

            $this->view->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
            return true;
        } else {
            return false;
        }
    }

} 
