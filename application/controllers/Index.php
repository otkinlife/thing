<?php
/**
 * @name IndexController
 * @author jkc
 * @desc 默认控制器
 */
class IndexController extends Base_Core {

	public function init() {
		parent::init();
	}

	/**
	 * 默认
	 */
	public function indexAction() {
		$this->forward('Admin_Index','Index');
	}

}
