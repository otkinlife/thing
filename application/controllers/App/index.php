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

    //app注册界面
    public function registerAction() {
        $this->getView()->display('index/register.phtml');
    }

    //登录校验
    public function loginAction() {
        $user_name = $this->getParam('user_name');
        $user_pwd =  $this->getParam('user_pwd');
        $lifeTime = 3600;
        session_set_cookie_params($lifeTime);
        session_start();
        $user = new userModel();
        $res = $user->login($user_name,$user_pwd);
        if($res) {
            $_SESSION['user_id'] = $res;
            $res = array('code' => '0', 'msg' => '登录成功');
        }else {
            $res = array('code' => '1', 'msg' => '登录失败');
        }
        echo json_encode($res);
    }

    //注册用户
    public function registerUserAction() {
        $user_name = $this->getParam('user_name');
        $user_pwd =  $this->getParam('user_pwd');
        $user_email =  $this->getParam('user_email');
        $user_sex = $this->getParam('user_sex');
        $user = new userModel();
        $res = $user->insertUser($user_name, $user_pwd, $user_email, '', $user_sex, '否');
        if($res) {
            $res = array('code' => '0', 'msg' => '注册成功');
        }else {
            $res = array('code' => '1', 'msg' => '注册失败');
        }
        echo json_encode($res);
    }
    //显示登录后的第一页
    public function showThingAction() {
        session_start();
        $id = $_SESSION['user_id'];
        $message = new messageModel();
        $num = $message->getMessageUnReadNum($id);
        $this->getView()->assign('num', $num);
        $this->getView()->display('index/thing.phtml');
    }

    //显示我的消息
    public function showMyInfoAction() {
        session_start();
        $id = $_SESSION['user_id'];
        $thing = new thingModel();
        $user = new userModel();
        $res = array();
        $userInfo = $user->getUserInfoById($id);
        $list = $thing->getMyThingList($id);
        foreach($list as $row) {
            $comments_num = $thing->getCountsOfThingByThingId($row['thing_id']);
            $row['comments_num'] = $comments_num;
            $res[] = $row;
        }
        $this->getView()->assign('myThingList', $res);
        $this->getView()->assign('userInfo', $userInfo);
        $this->getView()->display('index/myinfo.phtml');
    }

    //更新用户信息
    public function updateUserAction() {
        session_start();
        $id = $_SESSION['user_id'];
        $updatetype = $this->getParam('update_type');
        $value = $this->getParam('value');
        $user = new userModel();
        $res = $user->updateUserByType($id, $updatetype, $value);

        if($res) {
            $res = array('code' => '0', 'msg' => '更新成功');
        }else {
            $res = array('code' => '1', 'msg' => '更新失败');
        }
        echo json_encode($res);
    }

}