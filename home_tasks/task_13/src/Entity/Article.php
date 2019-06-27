<?php

namespace Entity;


/**
 * Class Article
 * @package Entity
 */
class Article extends BaseEntity
{
    /**
     * @var
     */
    private $title;
    /**
     * @var
     */
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
     * Get title
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get text
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

}
