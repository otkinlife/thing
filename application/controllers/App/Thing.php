<?php
class App_ThingController extends Base_Core {

    //显示所有的趣事
    public function showAllThingAction() {
        $thing = new thingModel();
        $res = array();
        $thingList = $thing->getAllThingList();
        foreach ($thingList as $list) {
            $thing_id = $list['thing_id'];
            $userInfo = $thing->getUserInfoByThingId($thing_id);
            $comments_num = $thing->getCountsOfThingByThingId($thing_id);
            $list['user_name'] = $userInfo[0]['user_name'];
            $list['user_email'] = $userInfo[0]['user_email'];
            $list['user_sex'] = $userInfo[0]['user_sex'];
            $list['num'] = $comments_num;
            $res[] = $list;
        }
        $this->getView()->assign('thingList', $res);
        $this->getView()->display('index/allthing.phtml');
    }

    //删除
    public function removeThingAction() {
        $thing_id = $this->getParam('thing_id');
        $thing = new thingModel();
        $res = $thing->removeThingById($thing_id);
        if($res) {
            $res = array('code' => '0','msg' => '删除趣事成功');
        }else {
            $res = array('code' => '1','msg' => '删除趣事失败');
        }
        echo json_encode($res);
    }

    /**
     * 查找趣事
     */
    public function findThingAction() {
        $thing = new thingModel();
        $page = $this->getParam('page');
        $pageSize = $this->getParam('rows');
        $pass = $this->getParam('pass');
        $keyword = $this->getParam('keyword');
        $res = $thing->findThing($keyword, $page, $pageSize, $pass);
        $total = $thing->countOfFindThing($keyword, $pass);
        $arr = array('total' => $total,'rows'=>$res);
        echo json_encode($arr);
    }

    /**
     * 审核趣事
     */
    public function passThingAction() {
        $thing = new thingModel();
        $thing_id = $this->getParam('thing_id');
        $res = $thing->passThing($thing_id);
        if($res) {
            $res = array('code' => '0','msg' => '审核成功');
        }else {
            $res = array('code' => '1','msg' => '审核失败');
        }
        echo json_encode($res);
    }

    /**
     *发表观点
     */
    public function addThingAction() {
        session_start();
        $id = $_SESSION['user_id'];
        $thing_content = $this->getParam('thing_content');
        $thing = new thingModel();
        $res = $thing->addThing($thing_content, $id);
        if($res) {
            $res = array('code' => '0','msg' => '发表成功');
        }else {
            $res = array('code' => '1','msg' => '发表失败');
        }
        echo json_encode($res);
    }


}