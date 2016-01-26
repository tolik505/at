<?php
/**
 * @author walter
 */

namespace frontend\helpers;


use yii\helpers\Html;

/**
 * Class ExtendedHtml
 * @package frontend\helpers
 */
class ExtendedHtml extends Html
{

    /**
     * Generates ajax hyperlink tag
     */
    public static function ajaxLink($text, $url = null, $options = [])
    {
        $options['class'] = isset($options['class'])
            ? $options['class'] . ' ajax-link'
            :
            'ajax-link';
        $options['rel'] = 'nofollow';
        $link = parent::a($text, $url, $options);
        return self::wrapInNoindexTag($link);
    }

    /**
     * Generates a hyperlink tag to another sites
     */
    public static function externalLink($text, $url = null, $options = [])
    {
        $options['rel'] = 'nofollow';
        $link = parent::a($text, $url, $options);
        return self::wrapInNoindexTag($link);
    }

    public static function wrapInNoindexTag($html)
    {
        return '<!--noindex-->' . $html . '<!--/noindex-->';
    }

}