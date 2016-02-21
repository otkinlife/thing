<?php

/**
 * 基类- 所有的控制器必须走这个方法
 * Class Base_Core
 */
class Base_Core extends Yaf_Controller_Abstract {

    public function init() {
        //关闭html自动渲染 只能在public/index.php进行关闭渲染
        //        Yaf_Dispatcher::getInstance()->disableView();
    }

    /**
     * 获取传递的参数
     * @param string $key key
     * @param bool|false $flag 是否返回原始数据
     * @param array $unset 需要清除的参数
     * @return array|string 返回获取到的值
     */
    public function getParam($key='',$flag=false,$unset=array()) {
        $yafHttp = new Yaf_Request_Http();
        if($yafHttp->isGet()) {
            $array = $yafHttp->getQuery();
            if ($key != '') {
                $array = $array[$key];
            }
        } else {
            if ($key != '') {
                $array = $yafHttp->getPost($key);
            } else {
                $array = $yafHttp->getPost();
                $arrayTem = $yafHttp->getQuery();

                $array = array_merge($array,$arrayTem);
            }
        }

        if (count($unset)>0) {
            foreach ($unset as $key) {
                unset($array[$key]);
            }
        }

        if($flag){
            return $array;
        }

        $tem = array();
        if(count($array) >0 && is_array($array)){
            foreach ($array  as $key => $val) {
                $tem[$key] = is_array($val) ? $val : addslashes(strip_tags($val));
            }
        }else{
            $tem = !empty($array) ? addslashes(strip_tags($array)) : '';
        }

        return $tem;
    }

    /**
     * 获取到session操作实例
     * @return Yaf_Session
     */
    public function getSession(){
        return $session = Yaf_Session::getInstance();
    }

}
