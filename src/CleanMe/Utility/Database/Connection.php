<?php

namespace CleanMe\Utility\Database;

use Symfony\Component\Yaml\Yaml;
use \PDO,\PDOException;

/**
 * Class Connection
 *
 * @package CleanMe\Services\Database
 */
class Connection
{
    const ATTR_PERSISTENT = false;
    const ATTR_EMULATE_PREPARES = false;
    const ATTR_ERRMODE = PDO::ERRMODE_EXCEPTION;
    const ATTR_TIMEOUT = 15;

    /** @var PDO $instance */
    private $instance;

    /**
     * Connection constructor.
     */
    function __construct()
    {
        $config = Yaml::parse(file_get_contents(CONFIG));
        $config = $config['database'];

        // create connection string
        $string = sprintf('mysql:%s', implode(';', [
            'host='. $config['host'],
            'port='. $config['port'],
            'dbname='. $config['table'],
            'charset='. $config['charset'],
        ]));

        try {
            // setup connection
            $this->instance = new PDO($string, $config['user'], $config['pass'], [
                PDO::ATTR_PERSISTENT => self::ATTR_PERSISTENT,
            ]);

            // if failed connection
            if (!$this->instance) {
                throw new \Exception('Could not connect to database.');
            }

            $this->instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, self::ATTR_EMULATE_PREPARES);
            $this->instance->setAttribute(PDO::ATTR_ERRMODE, self::ATTR_ERRMODE);
            $this->instance->setAttribute(PDO::ATTR_TIMEOUT, self::ATTR_TIMEOUT);
        } catch (PDOException $e) {
            throw $ex;
        }
    }

    /**
     * Flush away!
     */
    public function flush()
    {
        $this->instance = null;
    }

    /**
     * @param $sql
     * @param array $binds
     * @return array|mixed|string
     */
    public function query($sql, $binds = [])
    {
        try {
            // prepare and execute SQL statement
            $query = $this->instance->prepare($sql);

            // handle any bound parameters
            if ($binds) {
                foreach($binds as $param) {
                    list($name, $value) = $param;
                    $query->bindValue($name, $value);
                }
            }

            // execute query
            $query->execute();

            // get action
            $action = strtolower(explode(' ', $sql)[0]);

            // perform action
            if (in_array($action, ['insert'])) {
                return $this->instance->lastInsertId();
            }

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $ex) {
            throw $ex;
        }
    }
}