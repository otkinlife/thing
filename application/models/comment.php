<?php
class commentModel extends Base_Db {

    /**
     * @param $page
     * @param $pageSize
     * @return array
     */
    public function getCommentsList($page, $pageSize) {
        $start = $pageSize * ($page - 1);
        $arr = array('comment_id','comment_content','thing_id','user_id','create_time');
        $res = $this->db->from('thing_comments')
            ->offset($start)->limit($pageSize)
            ->select(null)
            ->select($arr)
            ->fetchAll();
        return $res;
    }

    /**
     * 获取记录数
     * @return int
     */
    public function getCountOfComments() {
        $res = $this->db->from('thing_comments')
            ->count();
        return $res;
    }

    /**
     * @param $comment_id
     * @return PDOStatement
     */
    public function removeCommentById($comment_id) {
        $res = $this->db->deleteFrom('thing_comments')
                ->where('comment_id',$comment_id)
                ->execute();
        return $res;
    }


    /**
     * @param $keyword 搜索关键词
     * @param $page 页数
     * @param $pageSize 每页条数
     * @return array
     */
    public function findComments($keyword, $page, $pageSize) {
        $start = $pageSize * ($page - 1);
        $arr = array('comment_id','comment_content','thing_id','user_id','create_time');
        $res = $this->db->from('thing_comments')
            ->select(null)
            ->select($arr)
            ->where("comment_id like '%$keyword%' or thing_id like '%$keyword%' or comment_content like '%$keyword%' or user_id like '%$keyword%'")
            ->offset($start)
            ->limit($pageSize)
            ->fetchAll();
        return $res;
    }

    /**
     * @param $keyword
     * @return int
     */
    public function countOfFindComments($keyword) {
        $res = $this->db->from('thing_comments')
            ->where("comment_id '%$keyword%' or thing_id like '%$keyword%' or comment_content like '%$keyword%' or user_id like '%$keyword%'")
            ->select(null)
            ->count();
        return $res;
    }

    public function getCommentsByThingId($thing_id) {
        $arr = array('comment_id','comment_content','thing_id','user_id','create_time');
        $res = $this->db->from('thing_comments')
            ->select(null)
            ->select($arr)
            ->where('thing_id', $thing_id)
            ->fetchAll();
        return $res;
    }

    public function addComment($comment_content, $thing_id, $user_id) {
        $arr = array(
            'comment_content' => $comment_content,
            'thing_id' => $thing_id,
            'user_id' => $user_id,
            'create_time' => date('Y-m-d H:i:s')
        );
        $res = $this->db->insertInto('thing_comments', $arr)
            ->execute();
        return $res;
    }

}