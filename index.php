<?php
include_once 'Db/DbConnection.php';
include_once 'Db/Db.php';
include_once 'Db/Model.php';
include_once 'Db/User.php';

User::createTable();

try {
    $data = Model::getDataFromGithub();
} catch (\Exception $e) {
    echo $e->getMessage();
}

Model::addUsers($data);
