<?php
require(__DIR__ . '/Mock.class.php');

Log::getLogger(array(
    'level' => Log::ALL
));

Mock::init(__DIR__ . '/test/www', 'utf-8');

var_dump(Mock::getData('a.tpl'));
var_dump(Mock::getData('b.tpl'));
