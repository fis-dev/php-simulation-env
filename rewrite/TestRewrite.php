<?php
require(__DIR__ . '/../log/Log.class.php');
require(__DIR__ . '/Rewrite.class.php');

define('WWW_ROOT', __DIR__);

Log::getLogger(array(
    'level' => Log::ALL
));

$rewrite = new Rewrite(__DIR__ . '/test');
$rewrite->addConfigFile('common.conf');
$rewrite->addConfigFile('home.conf');

$rewrite->run('/home/test');
