<?php
/**
 * Created by PhpStorm.
 * User: jkc
 * Date: 2016/2/21
 * Time: 9:25
 */

class Base_Db {

    public $db;

    function __construct(){
        mysql_query('set names utf8');
        $pdo = new PDO("mysql:dbname=thing", "root", "",array (PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8';"));
        $this->db = new PDO_FluentPDO($pdo);
    }
}