<?php

namespace Model;


include_once ZF . '/zend-db/src/TableGateway/TableGatewayInterface.php';
include_once ZF . '/zend-db/src/TableGateway/AbstractTableGateway.php';
include_once ZF . '/zend-db/src/TableGateway/TableGateway.php';

use Db\Db;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;

class User extends TableGateway
{

    public function __construct($table, AdapterInterface $adapter)
    {
        $db = new Db();

        parent::__construct('user', $db->getAdapter());
    }



    /** Получаем всех пользователей
     *
     * @return array|bool
     */
    public static function getAllUsers()
    {
        $table = self::$table;
        return self::fetchAll("SELECT * FROM `$table`");
    }

    /** Добавляем пользователя
     *
     * @param array $user
     */
    public static function updateUsers(array $user)
    {
        $table = self::$table;
        self::query("INSERT INTO `$table` SET `github_id` = ?, `github_login` = ?",
            [
                $user['id'],
                $user['login'],
            ]
        );
    }





}