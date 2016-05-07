<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/7
 * Time: 9:59
 */
class friendModel extends Base_Db {

    public function insertAttention($user_attention, $user_battertion) {
        $arr = array(
            'user_attention' => $user_attention,
            'user_battertion' => $user_battertion
        );
        $res = $this->db->insertInto('thing_friend', $arr)
            ->execute();
        return $res;
    }

    public function removeAttention($user_attention, $user_battertion) {
        $res = $this->db->deleteFrom('thing_friend')
            ->where('user_attention', $user_attention)
            ->where('user_battertion', $user_battertion)
            ->execute();
        return $res;
    }

    public function getFriendList($user_id) {
        $res = $this->db->from('thing_user')
            ->leftJoin('thing_friend on thing_user.id = thing_friend.user_battertion')
            ->leftJoin('thing_user on thing_user.id = thing_friend.user_attention')
            ->select(null)
            ->select('*')
            ->where('thing_friend.user_attention', $user_id)
            ->fetchAll();
        return $res;
    }
}