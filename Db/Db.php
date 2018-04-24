<?php

class Db
{
    /** @var mysqli  */
    protected static $db;
    /** @var string  */
    protected static $placeholderSymbol = '?';


    /**
     * @param string $query
     * @param mixed $params
     * @return string
     */
    public static function getQuery(string $query, $params = null) {
        $db = DbConnection::getDb();
        if (empty($params)) {
            return $query;
        }
        if (!is_array($params)) {
            $params = [$params];
        }
        foreach ($params as $param) {
            $pos = strpos($query, self::$placeholderSymbol);
            $arg = "'" . $db->real_escape_string($param) . "'";
            $query = substr_replace($query, $arg, $pos, strlen(self::$placeholderSymbol));
        }
        return $query;
    }

    /**
     * @param string $query
     * @param mixed $params
     * @return bool|mixed
     */
    public static function query(string $query, $params = false) {
        $db = DbConnection::getDb();
        $success = $db->query(self::getQuery($query, $params));
        if (!$success) {
            return false;
        }
        return $db->insert_id === 0 ? true : $db->insert_id;
    }

    /**
     * @param string $query
     * @param mixed $params
     * @return array|bool
     */
    public static function fetchAll(string $query, $params = false) {
        $result_set = self::getResultSet($query, $params);

        return $result_set ? self::resultSetToArray($result_set) : false;
    }

    /**
     * @param $query
     * @param mixed $params
     * @return array|bool
     */
    public static function fetchRow(string $query, $params = false) {
        $result_set = self::getResultSet($query, $params);

        return $result_set->num_rows != 1 ? false : $result_set->fetch_assoc();
    }

    /**
     * @param string $query
     * @param mixed $params
     * @return mixed
     */
    public static function fetchOne(string $query, $params = false) {
        $result_set = self::getResultSet($query, $params);
        if ((!$result_set) || ($result_set->num_rows != 1)) {
            return false;
        } else {
            $arr = array_values($result_set->fetch_assoc());
            return $arr[0];
        }
    }

    private static function getResultSet(string $query, $params = false)
    {
        $db = DbConnection::getDb();
        return $db->query(self::getQuery($query, $params));
    }

    /**
     * @param mysqli_result $result_set
     * @return array
     */
    private static function resultSetToArray(mysqli_result $result_set) {
        $array = [];
        while (($row = $result_set->fetch_assoc()) != false) {
            $array[] = $row;
        }
        return $array;
    }

    public function __destruct() {
        if (self::$db) {
            self::$db->close();
        }
    }
}