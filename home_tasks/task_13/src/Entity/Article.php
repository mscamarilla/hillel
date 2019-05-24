<?php
namespace Entity;

use Entity\BaseEntity;

class Article extends BaseEntity
{
    private $title;
    private $text;

    /**
     * Article constructor.
     * @param $title
     * @param $text
     */
    public function __construct($title, $text)
    {
        $this->title = $title;
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }


}
