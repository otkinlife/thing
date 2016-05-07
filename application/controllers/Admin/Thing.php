<?php
class Admin_ThingController extends Base_Core {

    //趣事列表显示
    public function thingListAction() {
        $this->getView()->display('admin/thing_list.phtml');
    }

    //审核趣事列表
    public function passThingListAction() {
        $this->getView()->display('admin/pass_thing_list.phtml');
    }

    //获取已审核的趣事列表
    public function getThingListAction() {
        $page = $this->getParam('page');
        $pageSize = $this->getParam('rows');
        $thing = new thingModel();
        $res = $thing->getThingList($page,$pageSize);
        $total = $thing->getCountOfThing();
        $arr = array('total' => $total,'rows'=>$res);
        echo json_encode($arr);
    }

    //未审核的趣事列表
    public function getPassThingListAction() {
        $page = $this->getParam('page');
        $pageSize = $this->getParam('rows');
        $thing = new thingModel();
        $res = $thing->getThingNoPass($page,$pageSize);
        $total = $thing->getNoPassCountOfThing();
        $arr = array('total' => $total,'rows'=>$res);
        echo json_encode($arr);
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
}