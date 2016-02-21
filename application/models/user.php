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

    public function insertUser($user_name, $user_pwd, $user_email, $user_head = null, $user_sex, $is_admin){
        $arr = array(
            'user_name' => $user_name,
            'user_pwd' => $user_pwd,
            'user_pwd' => $user_email,
            'user_email' => $user_email,
            'user_head_img' => $user_head,
            'user_sex' => $user_sex,
            'is_admin' => $is_admin
        );
        $res = $this->db->insertInto('thing_user',$arr)->execute();
        return $res;
    }
}