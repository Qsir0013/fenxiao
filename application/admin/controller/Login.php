<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Login as L;

class Login extends Controller
{
	public function index()
    {
		if(request()->isPost()){
			$login = new L();
			$admin = $login->index();
			if($admin){
				$this->success('登陆成功','Pro/index');
			}
		}else{
			return $this->fetch();
		}
    }
	
	public function singOut()
	{
		$A = session('A',NULL);
		if($A===NULL){
			$this->success('退出成功','Login/index');
		}else{
			msg('退出错误！');
		}
	}
	
	public function cinfo()
	{
		if(request()->isPost()){
			$login = new L();
			if($login->cinfo()){
				$this->success('账户信息修改成功，请重新登录！','Login/index');
			}
		}else{
			return $this->fetch();
		}
	}
}