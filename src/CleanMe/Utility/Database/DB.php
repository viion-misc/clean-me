<?php

namespace CleanMe\Utility\Database;

use \PDO;

/**
 * Class Database
 *
 * @package CleanMe\Services
 */
class DB extends Connection
{
    /**
     * @param $table
     * @param null $where
     * @return array|mixed|string
     */
    public function fetch($table, $where = null)
    {
        $sql = 'SELECT * FROM %s';

        // if no where, fire off the query
        if (!$where) {
            return $this->query(sprintf($sql, $table));
        }

        // build binds
        $binds = [];
        foreach($where as $field => $value) {
            $bind = ':a'.bin2hex(random_bytes(4));
            $binds[$field .' = '. $bind] = [
                $bind,
                $value
            ];
        }

        // combine where statements
        $where = implode(',', array_keys($binds));

        // update sql statement
        $sql = sprintf($sql .' WHERE %s', $table, $where);

        // return result
        return $this->query($sql, $binds);
    }

    /**
     * @param $table
     * @param $data
     */
    public function insert($table, $data)
    {
        // sql statement
        $sql = 'INSERT INTO %s (%s) VALUES (%s)';

        // build binds
        $binds = [];
        foreach($data as $field => $value) {
            $bind = ':a'. bin2hex(random_bytes(4));
            $binds[$bind] = [
                $bind,
                $value,
                is_numeric($value) ? PDO::PARAM_INT : PDO::PARAM_STR
            ];
        }

        // columns and values
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_keys($binds));

        // update sql statement
        $sql = sprintf($sql, $table, $columns, $values);

        // insert
        $this->query($sql, $binds);
    }
}