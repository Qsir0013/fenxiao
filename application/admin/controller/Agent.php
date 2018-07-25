<?php
namespace app\admin\controller;

use app\admin\model\Agent as A;

class Agent extends Base
{
	public function index()
	{
		$agent = new A;
		$this->assign('list',$agent->index());
		return $this->fetch();
	}
	
	public function add()
	{
		$agent = new A;
		if(request()->isPost()){
			$agent->add();
			$this->success('数据添加成功','Agent/index');
		}else{
			return $this->fetch();
		}
	}
	
	public function edit()
	{
		$agent = new A;
		if(request()->isPost()){
			$agent->edit();
			$this->success('该条数据修改成功','Agent/index');
		}else{
			$this->assign('info',$agent->show());
			return $this->fetch();
		}
	}
	
	public function del()
	{
		$agent = new A;
		if($agent->del()){
			$this->success('改条数据删除成功','Agent/index');
		};
	}
}