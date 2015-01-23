<?php

define('WWW_ROOT', __DIR__);

require(__DIR__ . '/../log/Log.class.php');
require(__DIR__ . '/Rewrite.class.php');


Log::getLogger(array(
    'level' => Log::ALL
));

$rewrite = new Rewrite(__DIR__ . '/test');
$rewrite->addConfigFile('home.conf');
$rewrite->addConfigFile('common.conf');

$rewrite->run('/home/test');
