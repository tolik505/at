<?php
use frontend\assets\AppAsset;

/* @var $this \yii\web\View */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="app">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Angular Yii Application</title>
<?php $this->head() ?>

<script>paceOptions = {ajax: {trackMethods: ['GET', 'POST']}};</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/red/pace-theme-minimal.css" rel="stylesheet" />
</head>
<body ng-controller="MainController">
<?php $this->beginBody() ?>
<div class="wrap">
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h2>
                <span>Toolbar with Standard Buttons</span>
            </h2>
            <span flex></span>
            <md-button>
                <a href="#/">Home</a>
            </md-button>
            <md-button>
                <a href="#/about">About</a>
            </md-button>
            <md-button>
                <a href="#/contact">Contact</a>
            </md-button>
            <md-button>
                <a href="#/dashboard">Dashboard</a>
            </md-button>
            <md-button ng-class="{active:isActive('/logout')}" ng-show="loggedIn()" ng-click="logout()"  class="ng-hide">
                <a href="#/dashboard">Logout</a>
            </md-button>
            <md-button ng-hide="loggedIn()">
                <a href="#/login">Login</a>
            </md-button>
        </div>
    </md-toolbar>

    <div class="container">
        <div ng-view>
        </div>
    </div>

</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <a href="http://blog.neattutorials.com">Neat Tutorials</a> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?> <?= Yii::getVersion() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
