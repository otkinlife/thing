<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/2
 * Time: 9:40
 */
class App_commentsController extends Base_Core {

    public function showCommentsListAction() {
        $thing_id = $this->getParam('thing_id');
        $comments = new commentModel();
        $thing = new thingModel();
        $thingarr = $thing->getOneThingById($thing_id);
        $res = $comments->getCommentsByThingId($thing_id);
        $this->getView()->assign('comments', $res);
        $this->getView()->assign('content', $thingarr);
        $this->getView()->display('index/comments.phtml');
    }

    public function addCommentAction() {
        session_start();
        $user_id= $_SESSION['user_id'];
        $comment_content = $this->getParam('comment_content');
        $thing_id = $this->getParam('thing_id');
        $comments = new commentModel();
        $res = $comments->addComment($comment_content, $thing_id, $user_id);
        if($res) {
            $res = array('code' => '0', 'msg' => '发表成功');
        }else {
            $res = array('code' => '1', 'msg' => '发表失败');
        }
        echo json_encode($res);
    }
}