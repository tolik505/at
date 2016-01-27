<?php

namespace backend\modules\admin\controllers;

use backend\components\BackendController;
use backend\modules\admin\models\AdminUser;
use backend\modules\admin\models\AdminUserSearch;
use Yii;


/**
 * AdminUserController implements the CRUD actions for AdminUser model.
 */
class AdminUserController extends BackendController
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return AdminUser::className();
    }

    public function actionIndexConfirm()
    {
        $class = $this->getModelClass();
        /** @var AdminUserSearch $searchModel */
        $searchModel = new AdminUserSearch();
        $dataProvider = $searchModel->searchToConfirm(Yii::$app->request->queryParams);

        return $this->render('index-confirm', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionRole($id)
    {
        /** @var AdminUser $model */
        $model = $this->findModel($id);

        return $this->render('role', ['model' => $model]);
    }

}
