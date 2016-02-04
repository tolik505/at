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
//        $this->getView()->registerMetaTag(['property' => 'fb:app_id', 'content' => '']);
        $this->getView()->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
        $this->getView()->registerMetaTag(['property' => 'og:description', 'content' => $this->description]);
        $this->getView()->registerMetaTag(['property' => 'og:url', 'content' => $this->url]);
        $this->getView()->registerMetaTag(['property' => 'og:image', 'content' => $this->image]);
        $this->getView()->registerMetaTag(['property' => 'og:image:width', 'content' => 1024]);
        $this->getView()->registerMetaTag(['property' => 'og:image:height', 'content' => 512]);

        //Twitter
        $this->getView()->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary_large_image']);
        $this->getView()->registerMetaTag(['name' => 'twitter:title', 'content' => $this->title]);
        $this->getView()->registerMetaTag(['name' => 'twitter:description', 'content' => $this->description]);
        $this->getView()->registerMetaTag(['name' => 'twitter:image', 'content' => $this->image]);
    }
}
