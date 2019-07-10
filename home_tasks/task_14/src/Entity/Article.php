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
     * @var
     */
    private $user;

    /**
     * Article constructor.
     * @param string $title
     * @param string $text
     * @param User $user
     */
    public function __construct(string $title, string $text, BaseEntity $user)
    {
        $this->title = $title;
        $this->text = $text;
        $this->user = $user;
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
