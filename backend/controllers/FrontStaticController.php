<?php
namespace backend\controllers;

use backend\components\SearchForFrontStatic;
use common\components\model\ActiveRecord;
use metalguardian\fileProcessor\helpers\FPM;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use Zelenin\yii\modules\I18n\controllers\DefaultController;
use Zelenin\yii\modules\I18n\models\search\SourceMessageSearch;

/**
 * Site controller
 */
class FrontStaticController extends DefaultController
{
    public function actionIndex()
    {
        $searchModel = new SearchForFrontStatic();
        $dataProvider = $searchModel->search(Yii::$app->getRequest()->get());
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * @param integer $id
     * @return string|Response
     */
    public function actionUpdate($id)
    {
        /** @var SourceMessage $model */
        $model = $this->findModel($id);
        $model->initMessages();

        if (Model::loadMultiple($model->messages, Yii::$app->getRequest()->post()) && Model::validateMultiple($model->messages)) {
            $model->saveMessages();
            Yii::$app->getSession()->setFlash('success', 'Перевод обновлен');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }
}
