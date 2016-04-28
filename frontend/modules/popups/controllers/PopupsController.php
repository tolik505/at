<?php

namespace frontend\modules\popups\controllers;

use app\modules\request\models\Request;
use common\models\Travel;
use frontend\modules\request\models\RequestCallback;
use frontend\modules\request\models\RequestExistTravel;
use frontend\modules\request\models\RequestMailUs;
use frontend\modules\request\models\RequestPersonalTravel;
use frontend\modules\request\models\RequestSubscribe;
use frontend\modules\request\widgets\subscribe\Subscribe;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Default controller for the `popups` module
 */
class PopupsController extends Controller
{

    public function actionMailUs()
    {
        $data = null;

        if (\Yii::$app->request->isAjax) {
            $model = new RequestMailUs();
            if ($model->load(\Yii::$app->request->post())) {
                if ($model->save()) {
                    $data = [
                        'replaces' => [
                            [
                                'data' => $this->renderPartial('RequestMailUsThanks', []),
                                'what' => '.popup'
                            ],
                        ],
                        'js' => Html::script('showPopup(); initButtonClosePopup()')
                    ];
                }
            }

            $data = $data
                ? $data
                : [
                    'replaces' => [
                        [
                            'data' => $this->renderPartial('RequestMailUs', ['model' => $model]),
                            'what' => '.popup'
                        ],
                    ],
                    'js' => Html::script('showPopup(); initButtonClosePopup()')
                ];

            echo Json::encode($data);
        }
    }
}
