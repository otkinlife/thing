<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/2
 * Time: 14:46
 */
class App_collectController extends Base_Core {

    public function showCollectAction() {
        session_start();
        $id = $_SESSION['user_id'];
        $collect = new collectModel();
        $friend = new friendModel();
        $res = $collect->getCollectedList($id);
        $friendList = $friend->getFriendList($id);
        $this->getView()->assign('friendList', $friendList);
        $this->getView()->assign('myCollectList', $res);
        $this->getView()->display('index/collect.phtml');
    }

    public function changeCollectAction() {
        session_start();
        $id = $_SESSION['user_id'];
        $thing_id = $this->getParam('thing_id');
        $collect = new collectModel();
        $res = $collect->changeCollect($thing_id, $id);
        echo json_encode($res);
    }

    public function attentionFriendAction() {
        session_start();
        $id = $_SESSION['user_id'];
        $friend_id = $this->getParam('friend_id');
        $friend = new friendModel();
        $res = $friend->insertAttention($id, $friend_id);
        if ($res) {
            $res = array('code' => '0', 'msg' => '关注成功');
        } else {
            $res = array('code' => '1', 'msg' => '关注失败');
        }
        echo json_encode($res);
    }

    public function removeFriendAction() {
        session_start();
        $id = $_SESSION['user_id'];
        $friend_id = $this->getParam('friend_id');
        $friend = new friendModel();
        $res = $friend->removeAttention($id, $friend_id);
        if ($res) {
            $res = array('code' => '0', 'msg' => '取消关注成功');
        } else {
            $res = array('code' => '1', 'msg' => '取消关注失败');
        }
        echo json_encode($res);
    }

    public function sendMessageAction() {
        session_start();
        $id = $_SESSION['user_id'];
        $friend_id = $this->getParam('friend_id');
        $message_content = $this->getParam('message_content');
        $message = new messageModel();
        $res = $message->sendMessage($id, $friend_id, $message_content);
        if ($res) {
            $res = array('code' => '0', 'msg' => '成功');
        } else {
            $res = array('code' => '1', 'msg' => '失败');
        }
        echo json_encode($res);
    }

    public function myMessageListAction () {
        session_start();
        $id = $_SESSION['user_id'];
        $message = new messageModel();
        $read = $message->readMessage($id);
        $res = $message->getMessageList($id);
        $this->getView()->assign('messageList', $res);
        $this->getView()->display('index/message.phtml');
    }
}