<?php

namespace Core;

/**
 * Class Model
 * @package Core
 */
abstract class Model
{
    /**
     * @var DatabaseExecution
     */
    protected $db;

    /**
     * Model constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->db = new DatabaseExecution();

    }

}
