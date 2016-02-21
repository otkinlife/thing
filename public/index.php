<?php

define('APPLICATION_PATH', dirname(dirname(__FILE__)));
define('ROOT_DOMAIN', "http://thing.jkc.com");

$application = new Yaf_Application( APPLICATION_PATH . "/conf/application.ini");

//开发环境开启除了notice之外的所有的错误提示
error_reporting(E_ALL ^E_NOTICE);

Yaf_Dispatcher::getInstance()->disableView();
$application->bootstrap()->run();
