<?php
namespace frontend\controllers;

use common\models\Robots;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
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

        return $this->renderContent($robots->text);
    }
}
