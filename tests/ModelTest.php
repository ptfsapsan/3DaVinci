<?php
include_once '../Db/DbConnection.php';
include_once '../Db/Db.php';
include_once '../Db/Model.php';

use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    public function testGetDataFromGithub()
    {
        $users = Model::getDataFromGithub();
        $this->assertEquals(count($users), 30);

        // проверяем поля первого элемента
        $user = current($users);
        $this->assertArrayHasKey('id', $user);
        $this->assertArrayHasKey('login', $user);
    }

}