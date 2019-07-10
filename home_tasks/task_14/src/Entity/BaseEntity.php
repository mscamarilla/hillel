<?php

namespace Entity;

/**
 * Class BaseEntity
 * @package Entity
 */
class BaseEntity
{
    /**
     * @var
     */
    private $id;

    /**
     * Get id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set id
     * @param $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

}
