<?php

namespace Entity;

use InterfaceNameSpace\DatabaseConfig;

/**
 * Class MysqlDatabase
 * @package Entity
 */
class MysqlDatabase
{
    /**
     * @var \MySQLi
     */
    private $link;

    /**
     * MysqlDatabase constructor.
     */
    public function __construct(MysqlConfig $config)
    {
        $this->connect($config);
    }


    /**
     * Mysql connection
     * @param \InterfaceNameSpace\DatabaseConfig $config
     * @throws \Exception
     */
    private function connect(DatabaseConfig $config): void
    {

        $connect = new \MySQLi(
            $config->getDbHostname(),
            $config->getDbUsername(),
            $config->getDbPassword(),
            $config->getDbName(),
            3306);

        $this->link = $connect;

        if ($this->link->connect_error) {
            throw new \Exception('MySQL DB connect failed!');

        } else {
            $this->link->set_charset("utf8");
            $this->link->query("SET SQL_MODE = ''");
        }

    }

    /**
     * Making query
     * @param string $sql
     * @return object|null
     * @throws \Exception
     */
    public function query(string $sql): ?object
    {
        $query = $this->link->query($sql);

        if (!$this->link->errno) {
            if ($query instanceof \mysqli_result) {
                $data = array();

                while ($row = $query->fetch_assoc()) {
                    $data[] = $row;
                }

                $result = new \stdClass();
                $result->num_rows = $query->num_rows;
                $result->row = isset($data[0]) ? $data[0] : array();
                $result->rows = $data;

                $query->close();

                return $result;
            } else {
                return null;
            }
        } else {
            throw new \Exception('Error: ' . $this->link->error . '<br />Error No: ' . $this->link->errno . '<br />' . $sql);
        }
    }

    /**
     * Escape value
     * @param string $value
     * @return string
     */
    public function escape(string $value): string
    {
        return $this->link->real_escape_string($value);
    }

}
