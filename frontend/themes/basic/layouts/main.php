<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

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
    <?= Yii::$app->config->get('endHead') ?>
</head>
<body class="page">
<?php $this->beginBody() ?>

    <?= \frontend\widgets\openGraphMetaTags\Widget::widget([
        'title' => 'Test title',
        'url' => Url::to(Url::current(['_pjax' => null]), true),
        'description' => 'Some test description',
        'image' => 'http://pbs.twimg.com/media/CaNtqoYUMAAENl3.jpg',
    ]); ?>

    <?= $content ?>

<div class="mask">   </div>
<div class="popup"></div>

<?php $this->endBody() ?>
<?= Yii::$app->config->get('endBody') ?>
</body>
</html>
<?php $this->endPage() ?>
