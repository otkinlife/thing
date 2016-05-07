<?php

class collectModel extends Base_Db {

    //收藏
    public function changeCollect($thing_id, $user_id) {
        $isCollected = $this->db->from('thing_collect')
            ->where('thing_id', $thing_id)
            ->where('user_id', $user_id)
            ->count();
        if ($isCollected) {
            $res = $this->db->deleteFrom('thing_collect')
                ->where('thing_id', $thing_id)
                ->where('user_id', $user_id)
                ->execute();
            if ($res) {
                $res = array(
                    "code" => 100,
                    "msg" => "取消收藏成功"
                );
            } else {
                $res = array(
                    "code" => 101,
                    "msg" => "取消收藏失败"
                );
            }
        } else {
            $arr = array(
                'thing_id' => $thing_id,
                'user_id' => $user_id
            );
            $res = $this->db->insertInto('thing_collect', $arr)
                ->execute();
            if ($res) {
                $res = array(
                    "code" => 200,
                    "msg" => "收藏成功"
                );
            } else {
                $res = array(
                    "code" => 201,
                    "msg" => "收藏失败"
                );
            }
        }
        return $res;
    }

    public function getCollectedList($user_id) {
        $res = $this->db->from('thing')
            ->leftJoin('thing_collect on thing.thing_id = thing_collect.thing_id')
            ->select(null)
            ->select('*')
            ->where('thing_collect.user_id', $user_id)
            ->fetchAll();
        return $res;
    }


}