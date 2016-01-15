<?php
/**
 * Created by metalguardian
 *
 */

namespace console\controllers;

use rmrevin\yii\postman\models\LetterModel;
use yii\console\Controller;

/**
 * Class SendController
 */
class SendController extends Controller
{
    public function actionIndex()
    {
        LetterModel::cron(10);
    }
}
