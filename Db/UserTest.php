<?php

class User extends DbTest
{
    private static $table = 'user';


    /**
     * @return bool
     */
    public static function hasTable()
    {
        $table = self::$table;
        $check = self::fetchRow("CHECK TABLE `$table`");
        return $check['Msg_text'] == 'OK';
    }

    /**
     *  Создаем таблицу если ее нет
     */
    public static function createTable()
    {
        if (self::hasTable()) {
            return;
        }
        $table = self::$table;
        self::query("CREATE TABLE $table (
              `github_id` int(11) UNSIGNED NOT NULL,
              `github_login` varchar(255) NOT NULL,
              PRIMARY KEY (github_id)
            ) ENGINE=InnoDB;");
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
    public static function addUser(array $user)
    {
        $table = self::$table;
        self::query("INSERT INTO `$table` SET `github_id` = ?, `github_login` = ?",
            [
                $user['id'],
                $user['login'],
            ]
        );
    }

    /** Добавляем пользователя
     *
     * @param array $user
     */
    public static function updateUser(array $user)
    {
        $table = self::$table;
        self::query("UPDATE `$table` SET `github_login` = ? WHERE `github_id` = ?",
            [
                $user['login'],
                $user['id'],
            ]
        );
    }




}