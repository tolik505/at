<?php
Yii::$container->set(
    \yii\data\Pagination::className(),
    \frontend\components\Pagination::className()
);

\yii\base\Event::on(
    \yii\web\View::className(),
    \yii\web\View::EVENT_BEGIN_PAGE,
    function () {
        $isAjaxRequest = Yii::$app->request->isAjax;
        if (!$isAjaxRequest) {
            \Yii::$app->view->registerLinkTag(
                [
                    'rel' => 'canonical',
                    'href' => \yii\helpers\Url::canonical()
                ]
            );
        }
    }
);
