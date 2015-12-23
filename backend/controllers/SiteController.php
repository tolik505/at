<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
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
                        'actions' => ['index', 'ajax-checkbox'],
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

        if ($modelID && $modelName && $attribute) {
            $model = $modelName::findOne($modelID);
            if ($model) {
                $model->$attribute = $model->$attribute ? 0 : 1;
                $model->save();
            }
        }
    }
}
