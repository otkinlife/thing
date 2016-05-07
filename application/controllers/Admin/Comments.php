<?php
class Admin_CommentsController extends Base_Core {

    //趣事评论列表显示
    public function commentsListAction() {
        $this->getView()->display('admin/comments_list.phtml');
    }

    //获取已审核的趣事列表
    public function getCommentsListAction() {
        $page = $this->getParam('page');
        $pageSize = $this->getParam('rows');
        $comment = new commentModel();
        $res = $comment->getCommentsList($page,$pageSize);
        $total = $comment->getCountOfComments();
        $arr = array('total' => $total,'rows'=>$res);
        echo json_encode($arr);
    }

    //删除
    public function removeCommentAction() {
        $comment_id = $this->getParam('comment_id');
        $comment = new commentModel();
        $res = $comment->removeCommentById($comment_id);
        if($res) {
            $res = array('code' => '0','msg' => '删除趣事成功');
        }else {
            $res = array('code' => '1','msg' => '删除趣事失败');
        }
        echo json_encode($res);
    }

    /**
     * 查找评论
     */
    public function findCommentsAction() {
        $comment = new commentModel();
        $page = $this->getParam('page');
        $pageSize = $this->getParam('rows');
        $keyword = $this->getParam('keyword');
        $res = $comment->findComments($keyword, $page, $pageSize);
        $total = $comment->countOfFindComments($keyword);
        $arr = array('total' => $total,'rows'=>$res);
        echo json_encode($arr);
    }
}