<?php

namespace Db;

include_once ZF . '/zend-db/src/Exception/ExceptionInterface.php';
include_once ZF . '/zend-db/src/Adapter/Exception/ExceptionInterface.php';
include_once ZF . '/zend-db/src/Exception/ErrorException.php';
include_once ZF . '/zend-db/src/Adapter/Exception/ErrorException.php';
include_once ZF . '/zend-db/src/Exception/RuntimeException.php';
include_once ZF . '/zend-db/src/Adapter/Exception/RuntimeException.php';
include_once ZF . '/zend-db/src/Exception/InvalidArgumentException.php';
include_once ZF . '/zend-db/src/Adapter/Exception/InvalidArgumentException.php';
include_once ZF . '/zend-db/src/Exception/UnexpectedValueException.php';
include_once ZF . '/zend-db/src/Adapter/Exception/UnexpectedValueException.php';
include_once ZF . '/zend-db/src/Adapter/Exception/InvalidQueryException.php';
include_once ZF . '/zend-db/src/ResultSet/ResultSetInterface.php';
include_once ZF . '/zend-db/src/ResultSet/AbstractResultSet.php';
include_once ZF . '/zend-db/src/ResultSet/ResultSet.php';
include_once ZF . '/zend-db/src/Adapter/Platform/PlatformInterface.php';
include_once ZF . '/zend-db/src/Adapter/Platform/AbstractPlatform.php';
include_once ZF . '/zend-db/src/Adapter/Platform/Mysql.php';
include_once ZF . '/zend-db/src/Adapter/Profiler/ProfilerAwareInterface.php';
include_once ZF . '/zend-db/src/Adapter/AdapterInterface.php';
include_once ZF . '/zend-db/src/Adapter/Adapter.php';
include_once ZF . '/zend-db/src/Adapter/Driver/ResultInterface.php';
include_once ZF . '/zend-db/src/Adapter/Driver/Mysqli/Result.php';
include_once ZF . '/zend-db/src/Adapter/StatementContainerInterface.php';
include_once ZF . '/zend-db/src/Adapter/Driver/StatementInterface.php';
include_once ZF . '/zend-db/src/Adapter/Driver/Mysqli/Statement.php';
include_once ZF . '/zend-db/src/Adapter/Driver/DriverInterface.php';
include_once ZF . '/zend-db/src/Adapter/Driver/Mysqli/Mysqli.php';
include_once ZF . '/zend-db/src/Adapter/Driver/ConnectionInterface.php';
include_once ZF . '/zend-db/src/Adapter/Driver/AbstractConnection.php';
include_once ZF . '/zend-db/src/Adapter/Driver/Mysqli/Connection.php';

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAbstractServiceFactory;
use Zend\Db\Adapter\Driver\Mysqli\Connection;
use Zend\Db\Adapter\Driver\Mysqli\Mysqli;

class Db
{

    private $adapter;

    public function __construct()
    {
        $this->adapter = new Adapter([
            'driver' => 'Mysqli',
            'host' => 'localhost',
            'user' => 'root',
            'pass' => '1123',
            'dbname' => 'test',
            'port' => NULL,
            'socket' => NULL,
        ]);

    }


    public function getAdapter()
    {
        return $this->adapter;
    }

}