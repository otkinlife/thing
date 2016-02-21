<?php

/**
 * Created by PhpStorm.
 * User: Jiakaichao
 * Date: 2016/1/31
 * Time: 12:44
 */
class Common_GetStatic
{
    /**
     * @param $static_type (选择加载文件的类型js,css,easyui)
     * @param string $file_url 文件的路径
     */
    public function getStaticUrl($static_type, $file_url='') {

        //定义路径
        $js_document = ROOT_DOMAIN.'/js/';
        $css_document = ROOT_DOMAIN."/css/";
        $easyui_document = ROOT_DOMAIN."/jquery-easyui-1.4/";

        switch($static_type) {
            case "js":
                $result_url = $js_document.$file_url;
                echo "<script type='text/javascript' src='".$result_url."'></script>";
                break;
            case "css":
                $result_url = $css_document.$file_url;
                echo "<link type='text/css' rel='stylesheet' href='".$result_url."'>";
                break;
            case "easyui":
                echo "<link rel='stylesheet' type='text/css' href='".$easyui_document."themes/default/easyui.css'>";
                echo "<link rel='stylesheet' type='text/css' href='".$easyui_document."themes/icon.css'>";
                echo "<script type='text/javascript' src='".$easyui_document."jquery.min.js'></script>";
                echo "<script type='text/javascript' src='".$easyui_document."jquery.easyui.min.js'></script>";
                echo "<script type='text/javascript' src='".$easyui_document."locale/easyui-lang-zh_CN.js'></script>";
                break;
        }
    }

    /**
     * 获取图片
     * @param $file_url 图片路径
     */
    public function getImg($file_url) {
        //定义路径
        $img_document = ROOT_DOMAIN.'/img/';
        echo $img_document.$file_url;
    }

    /**
     * 获取测试路径
     * @param $file_url 测试路径
     */
    public function getTest($file_url){
        //定义路径路径
        $test_document = ROOT_DOMAIN.'/test/';
        echo $test_document.$file_url;
    }

}