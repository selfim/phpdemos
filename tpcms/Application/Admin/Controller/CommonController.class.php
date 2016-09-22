<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * use Common\Model可不需要使用 框架会默认加载里面的内容
 * 
 */
class CommonController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->_init();
	}

	/**
	 * 初始化
	 * @return [type] [description]
	 */
	private function _init(){
		$isLogin = $this ->isLogin();
		if (!$isLogin) {
			//跳转到登录页面
			$this->redirect('/admin.php?c=login');
		}
	}
	/**
	 * 获取登录用户信息
	 * @return array [description]
	 */
	public function getLoginUser(){
		return session("adminUser");
	}

	/**
	 * 判定是否登录
	 * @return boolean [description]
	 */
	public function isLogin(){
		$user = $this ->getLoginUser();
		if ($user && is_array($user)) {
			return true;
		}
		return false;
	}
}