<?php
/**
 * Created by PhpStorm.
 * User: zwk
 * Date: 2016年1月31日 22:12:56
 */

class Admin_IndexController extends Base_Core {

    /**
     * 首页显示
     */
    public function indexAction() {
        $this->getView()->display('admin/index.phtml');
    }

    /**
     * 用户列表显示页面
     */
    public function userListAction() {
        $this->getView()->display('admin/user_list.phtml');
    }

    /**
     * 获取用户列表
     */
    public function getUsersListAction() {
        $page = $this->getParam('page');
        $pageSize = $this->getParam('rows');
        $user = new userModel();
        $res = $user->getUsersList($page,$pageSize);
        $total = $user->getCountOfUsers();
        $arr = array('total' => $total,'rows'=>$res);
        echo json_encode($arr);
    }

    public function insertUserAction() {
        $user = new userModel();
        $user_name = $this->getParam('user_name');
        $user_pwd = $this->getParam('user_pwd');
        $user_email = $this->getParam('user_email');
        $user_sex = $this->getParam('user_sex');
        $is_admin = $this->getParam('$is_admin');
        $user_head = null;
        $res = $user->insertUser($user_name, $user_pwd, $user_email, $user_head, $user_sex, $is_admin);
        if($res) {
            $res = array('code' => '0', 'msg' => '成功');
        }else {
            $res = array('code' => '1', 'msg' => '失败');
        }
        echo json_encode($res);
    }

}