<?php

namespace Entity;

use InterfaceNameSpace\DatabaseConfig;

/**
 * Class MysqlConfig
 * @package Entity
 */
class MysqlConfig extends DatabaseConfig
{
    /**
     * MysqlConfig constructor.
     */
    public function __construct()
    {
        $this->db_hostname = DB_HOSTNAME;
        $this->db_username = DB_USERNAME;
        $this->db_password = DB_PASSWORD;
        $this->db_name = DB_NAME;
    }
}
