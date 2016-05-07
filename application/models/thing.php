<?php
class thingModel extends Base_Db {

    /**
     * 获取趣事列表
     */
    public function getThingList($page, $pageSize) {
        $start = $pageSize * ($page - 1);
        $arr = array('thing_id','thing_content','user_id','create_time');
        $res = $this->db->from('thing')
            ->offset($start)->limit($pageSize)
            ->select(null)
            ->select($arr)
            ->where('thing_pass',1)
            ->fetchAll();
        return $res;
    }

    public function addThing($thing_content, $user_id) {
        $arr = array(
            'thing_content' => $thing_content,
            'user_id' => $user_id,
            'create_time' => date('Y-m-d H:i:s')
        );
        $res = $this->db->insertInto('thing', $arr)
            ->execute();
        return $res;
    }

    //获取所有的趣事列表
    public function getAllThingList() {
        $arr = array('thing_id','thing_content','user_id','create_time');
        $res = $this->db->from('thing')
            ->select(null)
            ->select($arr)
            ->where('thing_pass',1)
            ->fetchAll();
        return $res;
    }


    //获取所有的趣事列表
    public function getOneThingById($thing_id) {
        $arr = array('thing_id','thing_content','user_id','create_time');
        $res = $this->db->from('thing')
            ->select(null)
            ->select($arr)
            ->where('thing_id',$thing_id)
            ->fetchAll();
        return $res[0];
    }
    /**
     * 获取记录数
     * @return int
     */
    public function getCountOfThing() {
        $res = $this->db->from('thing')
            ->where('thing_pass',1)
            ->count();
        return $res;
    }


    /**
     * 获取未通过审核记录数
     * @return int
     */
    public function getNoPassCountOfThing() {
        $res = $this->db->from('thing')
            ->where('thing_pass',0)
            ->count();
        return $res;
    }

    /**
     * @param $thing_id
     * @return PDOStatement
     */
    public function removeThingById($thing_id) {
        $res = $this->db->deleteFrom('thing')
                ->where('thing_id',$thing_id)
                ->execute();
        return $res;
    }

    /**
     * 未通过的趣事列表
     * @param $page
     * @param $pageSize
     * @return array
     */
    public function getThingNoPass($page, $pageSize) {
        $start = $pageSize * ($page - 1);
        $arr = array('thing_id','thing_content','user_id','create_time');
        $res = $this->db->from('thing')
            ->offset($start)->limit($pageSize)
            ->select(null)
            ->select($arr)
            ->where('thing_pass',0)
            ->fetchAll();
        return $res;
    }

    /**
     * @param $keyword 搜索关键词
     * @param $page 页数
     * @param $pageSize 每页条数
     * @param $pass 是否审核通过
     * @return array
     */
    public function findThing($keyword, $page, $pageSize, $pass) {
        if(empty($pass)){
            $pass = '0';
        }
        $start = $pageSize * ($page - 1);
        $arr = array('thing_id','thing_content','user_id','create_time','comment_num','thing_pass');
        $res = $this->db->from('thing')
            ->select(null)
            ->select($arr)
            ->where("(thing_id like '%$keyword%' or thing_content like '%$keyword%' or user_id like '%$keyword%')")
            ->where('thing_pass', $pass)
            ->offset($start)
            ->limit($pageSize)
            ->fetchAll();
        return $res;
    }

    /**
     * @param $keyword
     * @return int
     */
    public function countOfFindThing($keyword, $pass) {
        if(empty($pass)){
            $pass = '0';
        }
        $res = $this->db->from('thing')
            ->where("(thing_id like '%$keyword%' or thing_content like '%$keyword%' or user_id like '%$keyword%')")
            ->where('thing_pass', $pass)
            ->select(null)
            ->count();
        return $res;
    }

    /**
     * 审核趣事
     * @param $thing_id
     * @return PDOStatement
     */
    public function passThing($thing_id) {
        $res = $this->db->update('thing', array('thing_pass'=>1))
            ->where('thing_id', $thing_id)
            ->execute();
        return $res;
    }

    /**
     * 根据趣事获取发表者的信息
     * @param $thing_id
     * @return array
     */
    public function getUserInfoByThingId($thing_id) {
        $arr = array('id','user_name','user_email','user_sex');
        $res = $this->db->from('thing_user')
            ->leftJoin('thing on thing_user.id = thing.user_id')
            ->select(null)
            ->select($arr)
            ->where('thing_id', $thing_id)
            ->fetchAll();
        return $res;
    }

    /**
     * 根据趣事获取评论数
     * @param $thing_id
     * @return int
     */
    public function getCountsOfThingByThingId($thing_id) {
        $res = $this->db->from('thing_comments')
            ->leftJoin('thing on thing_comments.thing_id = thing.thing_id')
            ->where('thing.thing_id', $thing_id)
            ->count();
        return $res;
    }

    public function getMyThingList($user_id) {
        $arr = array('thing_id','thing_content','user_id','create_time','thing_pass');
        $res = $this->db->from('thing')
            ->select(null)
            ->select($arr)
            ->where('user_id', $user_id)
            ->fetchAll();
        return $res;
    }
}