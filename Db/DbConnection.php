<?php


class DbConnection
{
    /** @var mysqli */
    private static $db;

    private static $db_config = [
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '1123',
        'DbTest' => 'test',
        'port' => NULL,
        'socket' => NULL,
    ];


    private static function init() {
        self::$db = new mysqli(
            self::$db_config['host'],
            self::$db_config['user'],
            self::$db_config['pass'],
            self::$db_config['DbTest'],
            self::$db_config['port'],
            self::$db_config['socket']
        );

        if (mysqli_connect_error()) {
            die('Ошибка подключения (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
        }
    }

    /**
     * @return mysqli
     */
    public static function getDb()
    {
        if (empty(self::$db)) {
            self::init();
        }

        return self::$db;
    }
}