<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/21
 * Time: 9:35
 */

class userModel extends Base_Db {

    /**
     * 获取用户列表
     * @return array
     */
    public function getUsersList($page, $pageSize) {
        $start = $pageSize * ($page - 1);
        error_log($start." ".$pageSize,3, 'jkc.log');
        $arr = array('id','user_name','user_email','user_sex','is_admin');
        $res = $this->db->from('thing_user')
                ->offset($start)->limit($pageSize)
                ->select(null)
                ->select($arr)->fetchAll();
        return $res;
    }

    /**
     * 获取用户记录数
     * @return int
     */
    public function getCountOfUsers() {
        $res = $this->db->from('thing_user')->count();
        return $res;
    }

    /**
     * @param $user_name 用户名
     * @param $user_pwd 用户密码
     * @param $user_email 用户邮箱
     * @param null $user_head 头像
     * @param $user_sex 用户性别
     * @param $is_admin 是否管理员
     * @return int
     */
    public function insertUser($user_name, $user_pwd, $user_email, $user_head, $user_sex, $is_admin) {
        $arr = array(
            'user_name' => $user_name,
            'user_pwd' => $user_pwd,
            'user_email' => $user_email,
            'user_head_img' => $user_head,
            'user_sex' => $user_sex,
            'is_admin' => $is_admin
        );
        $res = $this->db->insertInto('thing_user',$arr)->execute();
        return $res;
    }

    /**
     * @param $id 用户id
     * @return PDOStatement
     */
    public function removeUser($id) {
        $res = $this->db->deleteFrom('thing_user')
                ->where('id',$id)
                ->execute();
        return $res;
    }

    public function updateUser($id, $user_name, $user_pwd, $user_email, $user_head, $user_sex, $is_admin) {
        $arr = array(
            'user_name' => $user_name,
            'user_pwd' => $user_pwd,
            'user_email' => $user_email,
            'user_head_img' => $user_head,
            'user_sex' => $user_sex,
            'is_admin' => $is_admin
        );

        $res = $this->db->update('thing_user', $arr)
            ->where('id',$id)
            ->execute();
        return $res;
    }

    /**
     * @param $keyword 搜索关键词
     * @param $page 页数
     * @param $pageSize 每页条数
     * @return array
     */
    public function findUser($keyword, $page, $pageSize) {
        $start = $pageSize * ($page - 1);
        $arr = array('id','user_name','user_email','user_sex','is_admin');
        $res = $this->db->from('thing_user')
            ->select(null)
            ->select($arr)
            ->where("id like '%$keyword%' or user_name like '%$keyword%' or user_email like '%$keyword%'")
            ->offset($start)
            ->limit($pageSize)
            ->fetchAll();
        return $res;
    }

    /**
     * @param $keyword
     * @return int
     */
    public function countOfFindUser($keyword) {
        $res = $this->db->from('thing_user')
            ->where("id like '%$keyword%' or user_name like '%$keyword%' or user_email like '%$keyword%'")
            ->select(null)
            ->count();
        return $res;
    }

    /**
     * 登录校验
     * @param $user_name
     * @param $user_pwd
     * @return int
     */
    public function login($user_name, $user_pwd) {
        $res = $this->db->from('thing_user')
            ->where('user_name', $user_name)
            ->where('user_pwd', $user_pwd)
            ->count();
        return $res;
    }
}