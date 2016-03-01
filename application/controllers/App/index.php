<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/27
 * Time: 13:06
 */

class App_IndexController extends Base_Core {

    //app登录页面
    public function indexAction() {
        $this->getView()->display('index/index.phtml');
    }

    //登录校验
    public function loginAction() {
        $user_name = $this->getParam('user_name');
        $user_pwd =  $this->getParam('user_pwd');
        $user = new userModel();
        $res = $user->login($user_name,$user_pwd);
        if($res) {
            $res = array('code' => '0', 'msg' => '登录成功');
        }else {
            $res = array('code' => '1', 'msg' => '登录失败');
        }
        echo json_encode($res);
    }

    //显示登录后的第一页
    public function showThingAction() {
        $this->getView()->display('index/thing.phtml');
    }

    //显示所有的趣事
    public function showAllThingAction() {
        $this->getView()->display('index/allthing.phtml');
    }

    //显示我的消息
    public function showMyInfoAction() {
        $this->getView()->display('index/myinfo.phtml');
    }
}