<?php

namespace InterfaceNameSpace;

/**
 * Class DatabaseConfig
 * @package InterfaceNameSpace
 */
abstract class DatabaseConfig
{
    /**
     * @var
     */
    protected $db_hostname;
    /**
     * @var
     */
    protected $db_username;
    /**
     * @var
     */
    protected $db_password;
    /**
     * @var
     */
    protected $db_name;


    /**
     * Get Hostname
     * @return string
     */
    public function getDbHostname(): string
    {
        return $this->db_hostname;
    }


    /**
     * Get DB Username
     * @return string
     */
    public function getDbUsername(): string
    {
        return $this->db_username;
    }

    /**
     * Get DB Password
     * @return string
     */
    public function getDbPassword(): string
    {
        return $this->db_password;
    }

    /**
     * Get DB name
     * @return string
     */
    public function getDbName(): string
    {
        return $this->db_name;
    }

}
