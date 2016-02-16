<?php
/**
 * Author: Pavel Naumenko
 */

namespace frontend\widgets\openGraphMetaTags;

/**
 * Class Widget
 *
 * @package frontend\widgets\openGraphMetaTags
 */
class Widget extends \yii\base\Widget
{
    /**
     * @var
     */
    public $title;

    /**
     * @var
     */
    public $description;

    /**
     * @var
     */
    public $url;

    /**
     * @var
     */
    public $image;

    /**
     *
     */
    public function run()
    {
        $view = $this->getView();

//        $this->getView()->registerMetaTag(['property' => 'fb:app_id', 'content' => '']);
        $view->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
        $view->registerMetaTag(['property' => 'og:description', 'content' => $this->description]);
        $view->registerMetaTag(['property' => 'og:url', 'content' => $this->url]);
        $view->registerMetaTag(['property' => 'og:image', 'content' => $this->image]);
        $view->registerMetaTag(['property' => 'og:image:width', 'content' => 1024]);
        $view->registerMetaTag(['property' => 'og:image:height', 'content' => 512]);

        //Twitter
        $view->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary_large_image']);
        $view->registerMetaTag(['name' => 'twitter:title', 'content' => $this->title]);
        $view->registerMetaTag(['name' => 'twitter:description', 'content' => $this->description]);
        $view->registerMetaTag(['name' => 'twitter:image', 'content' => $this->image]);
    }
}
