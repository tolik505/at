<?php
namespace help;

use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\JsExpression;

/**
 * @param $var
 * @param int $exit
 * @param int $depth
 * @param bool $highlight
 */
function dump($var, $exit = 1, $depth = 10, $highlight = true) {
    VarDumper::dump($var, $depth, $highlight);
    if ($exit) {
        exit();
    }
}

/**
 * @param $message
 * @param string $category
 * @param array $params
 * @param null|string $language
 * @return string
 */
function t($message, $category = 'app', $params = [], $language = null) {
    $prefix = 'front/';
    return yiit($message, $prefix . $category, $params, $language);
}

/**
 * @param $message
 * @param string $category
 * @param array $params
 * @param null|string $language
 * @return string
 */
function bt($message, $category = 'app', $params = [], $language = null) {
    $prefix = 'back/';
    return yiit($message, $prefix . $category, $params, $language);
}

/**
 * @param $message
 * @param string $category
 * @param array $params
 * @param null|string $language
 * @return string
 */
function yiit($message, $category, $params = [], $language = null) {
    return Yii::t($category, $message, $params, $language);
}

/**
 * @param $content
 * @param bool $doubleEncode
 *
 * @return string
 */
function encode($content, $doubleEncode = true) {
    return Html::encode($content, $doubleEncode);
}

/**
 * @param $alias
 * @param bool $throwException
 *
 * @return bool|string
 */
function alias($alias, $throwException = true) {
    return Yii::getAlias($alias, $throwException);
}

/**
 * @param $text
 * @param null $url
 * @param array $options
 *
 * @return string
 */
function a($text, $url = null, $options = []) {
    return Html::a($text, $url, $options);
}

/**
 * @param $content
 * @return string
 */
function text($content)
{
    return \nl2br(encode($content));
}

/**
 * @param $content
 * @return string
 */
function asUrl($content)
{
    return Yii::$app->formatter->asUrl($content);
}

/**
 * @param $data
 * @return string
 */
function base64url_encode($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

/**
 * @param $data
 * @return string
 */
function base64url_decode($data)
{
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

/**
 * Register flash with js in session
 *
 * @param $js
 */
function executeJs($js)
{
    Yii::$app->session->setFlash('executeJs', new JsExpression($js));
}
