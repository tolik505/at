<?php
/**
 * Created by PhpStorm.
 * User: dvixi
 * Date: 4/17/16
 * Time: 3:55 PM
 */

namespace console\controllers;


use yii\console\Controller;
use phpbu\App\Cmd;

class BackupController extends Controller
{
    public function actionIndex()
    {
        $configPath = \Yii::getAlias('@console/../backup/phpbu.json');
        $phpbu = new Cmd();
        $phpbu->run(['--configuration=' . $configPath]);
    }
}