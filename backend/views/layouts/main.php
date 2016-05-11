<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo \backend\modules\menu\widgets\MainMenu::widget();
            echo \backend\modules\menu\widgets\RightBarMenu::widget();
            echo \backend\modules\menu\widgets\LoginMenu::widget();
            NavBar::end();
        ?>

        <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= \backend\widgets\Alert::widget([
            'closeButton' => [
                'label' => ''
            ]
        ]); ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <p>With love
                        <a class="vintage-logo" href="http://www.vintage.com.ua/">
                            <svg viewBox="63.9 301.6 84.2 115.5">
                                <polygon points="85.6,301.6 63.9,301.6 68.9,321.4 90.5,321.4 "></polygon>
                                <polygon points="127,301.6 97.6,417.1 118.6,417.1 148,301.6 "></polygon>
                            </svg>
                        </a></p>
                </div>
                <div class="col-sm-4">
                    <p class="text-center">© by Vintage, All Rights Reserved. <?= date('Y') ?></p>
                </div>
                <div class="col-sm-4">
                    <p class="text-right"><?= Yii::powered() ?></p>
                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
