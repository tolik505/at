<?php
namespace frontend\controllers;

use common\models\Robots;
use frontend\assets\AppAsset;
use frontend\components\FrontendController;
use frontend\models\Sample;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends FrontendController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRobots()
    {
        $robots = Robots::find()->one();

        if (!$robots) {
            throw new NotFoundHttpException();
        }

        $this->layout = false;

        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = \Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/plain');

        $text = $robots->text;

        $text .= "\nSitemap: " . Url::to(['/sitemap/default/index'], true);

        return $this->renderContent($text);
    }
}
