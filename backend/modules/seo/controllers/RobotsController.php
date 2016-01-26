<?php

namespace backend\modules\seo\controllers;

use backend\components\BackendController;
use backend\modules\seo\models\Robots;
use yii\web\NotFoundHttpException;

/**
 * RobotsController implements the CRUD actions for Robots model.
 */
class RobotsController extends BackendController
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Robots::className();
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model =  $this->getModelClass();
        $page = $model::find()->one();

        if ($page) {
            $this->redirect(['update', 'id' => $page->id]);
        } else {
            $this->redirect(['create']);
        }
    }

    public function actionCreate()
    {
        $page = Robots::find()->one();
        if (is_object($page))
            $this->redirect(['update', 'id' => $page->id]);

        $class = $this->getModelClass();
        /** @var \yii\db\ActiveRecord $model */
        $model = new $class();

        if ($this->loadModels($model) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('//templates/create', [
                    'model' => $model,
                ]);
        }
    }

    /**
     * Updates an existing Robots model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->loadModels($model) && $model->save()) {
            \Yii::$app->getSession()->setFlash('info', \Yii::t('app', 'Record successfully updated!'));
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('//templates/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        throw new NotFoundHttpException;
    }
}
