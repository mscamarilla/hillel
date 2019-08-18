<?php


namespace Core;


/**
 * Class Database
 * @package Core
 */
class Database implements DatabaseInterface
{
    /**
     * @var object
     */
    private static $instance;

    /**
     * @var object
     */
    public $db;

    /**
     * @return object
     * @throws \Exception
     */
    public static function getInstance(): object
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Database constructor.
     * @throws \Exception
     */
    private function __construct()
    {
        $this->db = $this->makeConnection();
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * @return object
     * @throws \Exception
     */
    public function makeConnection(): object
    {
        $config = parse_ini_file(__DIR__ . '/../../config.ini', true);

        $connect = new \MySQLi(
            $config['db']['db_host'],
            $config['db']['db_user'],
            $config['db']['db_password'],
            $config['db']['db_name'],
            3306);

        $db = $connect;

        if ($db->connect_error) {
            throw new \Exception('MySQL DB connect failed!');

        } else {
            $db->set_charset("utf8");
            $db->query("SET SQL_MODE = ''");
        }

        return $db;

    }

}
