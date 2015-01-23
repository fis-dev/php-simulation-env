<?php
require(__DIR__ . '/Mock.class.php');

Mock::init(__DIR__ . '/test/www');

var_dump(Mock::getData('a.tpl'));
var_dump(Mock::getData('b.tpl'));
