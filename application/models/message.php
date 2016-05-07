<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/7
 * Time: 16:15
 */
class messageModel extends Base_Db {

    public function sendMessage($user_sender, $user_receiver, $message_content) {
        $arr = array(
            'user_sender' => $user_sender,
            'user_receiver' => $user_receiver,
            'message_content' => $message_content
        );
        $res = $this->db->insertInto('thing_message', $arr)
            ->execute();
        return $res;
    }

    //ÒÑ¶Á
    public function readMessage($user_id) {
        $res = $this->db->update('thing_message', array('is_read' => 1))
            ->where('user_receiver', $user_id)
            ->execute();
        return $res;
    }

    public function getMessageList($user_id) {
        $res = $this->db->from('thing_message')
            ->leftJoin('thing_user on thing_user.id = thing_message.user_sender')
            ->select(null)
            ->select('*')
            ->where('thing_message.user_receiver', $user_id)
            ->fetchAll();
        return $res;
    }

    public function getMessageUnReadNum($user_id) {
        $res = $this->db->from('thing_message')
            ->leftJoin('thing_user on thing_user.id = thing_message.user_sender')
            ->select(null)
            ->select('*')
            ->where('thing_message.user_receiver', $user_id)
            ->where('is_read', 0)
            ->count();
        return $res;
    }
}