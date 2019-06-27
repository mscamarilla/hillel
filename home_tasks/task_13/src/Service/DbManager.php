<?php

namespace Service;

/**
 * Class DbManager
 * @package Service
 */
class DbManager
{
    /**
     * @var \MySQLi
     */
    private $link;

    /**
     * DbManager constructor.
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param string $database
     * @param string $port
     */
    public function __construct(string $hostname, string $username, string $password, string $database, string $port = '3306')
    {
        $this->link = new \MySQLi($hostname, $username, $password, $database, $port);

        if ($this->link->connect_error) {
            trigger_error('Error: Could not make a database link (' . $this->link->connect_errno . ') ' . $this->link->connect_error);
            exit();
        }

        $this->link->set_charset("utf8");
        $this->link->query("SET SQL_MODE = ''");
    }

    /**
     * Query making
     * @param string $sql
     * @return object|null
     */
    public function query(string $sql):?object
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
            trigger_error('Error: ' . $this->link->error . '<br />Error No: ' . $this->link->errno . '<br />' . $sql);
        }
    }

    /**
     * Escape value
     * @param string $value
     * @return string
     */
    public function escape(string $value):string
    {
        return $this->link->real_escape_string($value);
    }

}
