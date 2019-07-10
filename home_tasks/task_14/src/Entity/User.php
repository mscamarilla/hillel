<?php

namespace Entity;

/**
 * Class User
 * @package Entity
 */
class User extends BaseEntity
{
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $surname;

    /**
     * User constructor.
     * @param $name
     * @param $surname
     */
    public function __construct($name, $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    /**
     * Get name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get surname
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

}
