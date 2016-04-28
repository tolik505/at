<?php

namespace backend\modules\departmentOnMap\controllers;

use backend\components\BackendController;
use backend\modules\departmentOnMap\models\DepartmentOnMap;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * DepartmentOnMapController implements the CRUD actions for DepartmentOnMap model.
 */
class DepartmentOnMapController extends BackendController
{

    public function actionIndex()
    {

        $class = $this->getModelClass();
        /** @var BackendModel $searchModel */
        $searchModel = (new $class)->getSearchModel();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        $markersForPreviewMap = $this->getMarkerJsonString();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'markersForPreviewMap' => $markersForPreviewMap,
        ]);
    }

    public function getModelClass()
    {
        return DepartmentOnMap::className();
    }

    public function getMarkerJsonString(){

        return json_encode(DepartmentOnMap::find()->select('lat, long')->isPublished()->asArray()->all());

    }
}
