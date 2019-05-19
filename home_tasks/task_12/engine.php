<?php

/**
 * Class Registry
 * Saves other classes to provide quick access to them from any place of the application
 */
class Registry
{
    private $data = array();


    /**
     * Set registry
     * @param string $key
     * @param object $obj
     */

    function set(string $key, object $obj)
    {
        if (!$this->has($key)) {
            $this->data[$key] = $obj;
        }
    }

    /**
     * Get registry
     * @param string $key
     * @return mixed
     */

    function get(string $key)
    {
        return $this->data[$key];
    }

    /**
     * Key check
     * @param string $key
     * @return bool
     */

    public function has(string $key)
    {
        return isset($this->data[$key]);
    }
}

/**
 * Class DB creates connection to DB
 */
class DB
{
    private $link;

    /**
     * DB constructor.
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param string $database
     * @param string $port
     */

    public function __construct(string $hostname, string $username, string $password, string $database, string $port = '3306')
    {
        $this->link = new MySQLi($hostname, $username, $password, $database, $port);

        if ($this->link->connect_error) {
            trigger_error('Error: Could not make a database link (' . $this->link->connect_errno . ') ' . $this->link->connect_error);
            exit();
        }

        $this->link->set_charset("utf8");
        $this->link->query("SET SQL_MODE = ''");
    }

    /**
     * Making db query
     * @param string $sql
     * @return bool|stdClass
     */

    public function query(string $sql)
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
                return true;
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
    public function escape(string $value)
    {
        return $this->link->real_escape_string($value);
    }


    /**
     * Get last ID from DB
     * @return mixed
     */

    public function getLastId()
    {
        return $this->link->insert_id;
    }

}

/**
 * Class Loader
 * Loading article.php
 */
class Loader
{
    protected $registry;

    /**
     * Loader constructor.
     * @param $registry
     */
    function __construct($registry)
    {
        $this->registry = $registry;
    }

    /**
     * Loading article.php
     * @param string $name
     * @param string $action
     * @return mixed
     */

    function controller(string $name, $action = 'index')
    {
        $file = $name . '.php';
        if (is_file($file)) {
            require_once $file;
            $controller = new $name($this->registry);
            return $controller->$action();
        }
    }

}
