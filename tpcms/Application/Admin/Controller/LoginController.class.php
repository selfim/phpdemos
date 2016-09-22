<?php 
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
    	if (session('adminUser')){
    		$this->redirect('/index.php?m=admin&c=index');
    	}
      $this->display();
    }
    public function check(){
    	//echo "check success";
		//print_r($_POST);
		$username = $_POST['username'];
		$password = $_POST['password'];
		if (! trim($username)) {
			//exit('username为空');
		return	show(0,'用户名不能为空');
		}
		if (! trim($password)) {
			//exit('username为空');
		return	show(0,'密码不能为空');
		}
		$ret =D('Admin')->getAdminByUsername($username);
		//$res=getMd5Password($password);
		//print_r($res);exit();
		if (!$ret) {
			return show(0,'该用户不存在');
		}
		if ($ret['password'] != getMd5Password($password)) {
			return show(0,'密码错误');
		}
		session('adminUser',$ret);
		return show(1,'登录成功');
    }

    public function loginout(){
    	session('adminUser',null);
    	$this->redirect('/index.php?m=admin&c=login&a=index');//&a=index可以不写
    }

}