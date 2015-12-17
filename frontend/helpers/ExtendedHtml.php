<?php
/**
 * @author walter
 */

namespace frontend\helpers;


use yii\helpers\Html;

class ExtendedHtml extends Html
{

    public static function ajaxLink($text, $url = null, $options = [])
    {
        $options['class'] = isset($options['class'])
            ? $options['class'] . ' ajax-link'
            :
            'ajax-link';
        $options['rel'] = 'noindex/nofollow';
        return parent::a($text, $url, $options);
    }

    public static function externalLink($text, $url = null, $options = [])
    {
        $options['rel'] = 'noindex/nofollow';
        return parent::a($text, $url, $options);
    }

}