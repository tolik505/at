<?php

namespace backend\modules\admin\controllers;

use backend\components\BackendController;
use backend\modules\admin\models\User;
use backend\modules\admin\models\UserSearch;
use common\models\UserFile;
use Yii;
use yii\helpers\FileHelper;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BackendController
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return User::className();
    }

    public function actionIndexConfirm()
    {
        $class = $this->getModelClass();
        /** @var UserSearch $searchModel */
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->searchToConfirm(Yii::$app->request->queryParams);

        return $this->render('index-confirm', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionDelete($id)
    {
        /** @var User $user */
        $user = $this->findModel($id);

        $user->status = User::STATUS_DELETED;

        $user->save(true, ['status']);

        return $this->redirect(['index']);
    }

    public function actionRole($id)
    {
        /** @var User $model */
        $model = $this->findModel($id);

        return $this->render('role', ['model' => $model]);
    }

    public function actionFile($id)
    {
        /** @var User $user */
        $user = Yii::$app->user->getIdentity();
        /** @var UserFile $model */
        $model = UserFile::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        list($data, $filename) = $model->decodeFile();

        Yii::$app->response->sendContentAsFile($data, $filename, ['mimeType' => FileHelper::getMimeTypeByExtension($filename), 'inline' => true]);
    }

    /**
     * @param array $id
     * @param $key
     * @param $attribute
     * @param $value
     * @param $baseAttribute
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionChange2(array $id, $key, $attribute, $value, $baseAttribute)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        /** @var User $model */
        $model = $this->findModel($id);

        $model->{$attribute} = $value;

        if ($model->save(true, [$attribute, 'updated_at'])) {
            return [
                'replace' => [
                    [
                        'what' =>  $key,
                        'data' => $model->generateCheckViewAttribute($baseAttribute, true),
                    ],
                ],
            ];
        }

        return [
            'error' => [$attribute => $model->getErrors($attribute)],
        ];
    }
}
