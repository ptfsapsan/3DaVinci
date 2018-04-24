<?php
include_once '../Db/DbConnection.php';
include_once '../Db/Db.php';


use PHPUnit\Framework\TestCase;

class DbTest extends TestCase
{
    public function testDb()
    {
        // проверяем класс соединения
        $db = DbConnection::getDb();
        $this->assertEquals(get_class($db), 'mysqli');

        // проверяем не создается ли другое соединение при повторном обращении
        $db2 = DbConnection::getDb();
        $this->assertSame($db, $db2);
    }
}