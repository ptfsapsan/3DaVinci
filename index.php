<?php
defined('ROOT') || define('ROOT', realpath(__DIR__));
defined('ZF') || define('ZF', realpath(ROOT . '/vendor/zendframework'));


include_once ROOT . '/Db/Db.php';
include_once ROOT . '/Model/Model.php';
include_once ROOT . '/Model/User.php';

include_once ZF . '/zend-console/src/Exception/ExceptionInterface.php';
include_once ZF . '/zend-console/src/Exception/RuntimeException.php';
include_once ZF . '/zend-console/src/Getopt.php';

use Zend\Console\Getopt;
use Model\Model;



$getopt = new Getopt([
    'action|a' => 'action to perform',
    'help|h' => 'displays usage information',
]);

$getopt->parse();
$options = $getopt->getOptions();

// выводим подсказку
if (in_array('help', $options)) {
    echo $getopt->getUsageMessage();
}

// выполняем приложение
if (in_array('action', $options)) {
    $model = new Model();
    $model->init();

    try {
        $data = Model::getDataFromGithub();
    } catch (\Exception $e) {
        echo $e->getMessage();
        return;
    }

    //$model->updateUsers($data);
}
