<?php
/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var \yii\base\Application|WebApplication|\yii\console\Application|\yii\web\Application the application instance
     */
    public static $app;
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = include(__DIR__ . '/../vendor/yiisoft/yii2/classes.php');
Yii::$container = new yii\di\Container;

/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property \common\components\User $user The user component. This property is read-only. Extended component.
 * @method \common\components\User getUser()
 */
class WebApplication extends yii\web\Application
{
}
