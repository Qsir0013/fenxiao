<?php
namespace app\admin\controller;

use app\admin\model\User as U;

class User extends Base
{
	public function index()
	{
		$user = new U;
		$this->assign('list',$user->index());
		return $this->fetch();
	}
	
	public function edit()
	{
		$user = new U;
		if(request()->isPost()){
			$user->edit();
			$this->success('该条数据修改成功','User/index');
		}else{
			$this->assign(['info'=>$user->show(),'agent'=>$user->agent()]);
			return $this->fetch();
		}
	}
	
	public function del()
	{
		$user = new U;
		if($user->del()){
			$this->success('改条数据删除成功','User/index');
		};
	}
}