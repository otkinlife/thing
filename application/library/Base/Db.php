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
        $pdo = new PDO("mysql:dbname=thing", "root", "");
        $this->db = new PDO_FluentPDO($pdo);
    }
}