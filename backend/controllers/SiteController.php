<?php
namespace backend\controllers;

use metalguardian\fileProcessor\helpers\FPM;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'ajax-checkbox', 'delete-file'],
                        'allow' => true,
                        'roles' => [\common\models\User::ROLE_ADMIN],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAjaxCheckbox()
    {
        $modelID = Yii::$app->request->post('modelId');
        $modelName = Yii::$app->request->post('modelName');
        $attribute = Yii::$app->request->post('attribute');

        if (Yii::$app->request->isAjax && $modelID && $modelName && $attribute) {
            $model = $modelName::findOne($modelID);
            if ($model) {
                $model->$attribute = $model->$attribute ? 0 : 1;
                $model->save();
            }
        }
    }

    public function actionDeleteFile()
    {
        $modelID = Yii::$app->request->post('modelId');
        $modelName = Yii::$app->request->post('modelName');
        $attribute = Yii::$app->request->post('attribute');

        if (Yii::$app->request->isAjax && $modelID && $modelName && $attribute) {
            $error = true;
            $model = $modelName::findOne($modelID);
            if ($model) {
                $fileId = $model->$attribute;
                $model->$attribute = null;
                if ($model->save()) {
                    FPM::deleteFile($fileId);
                    $error = false;
                }
            }

            return Json::encode(['error' => $error]);
        }

        return false;
    }
}
