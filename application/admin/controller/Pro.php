<?php
namespace app\admin\controller;

use app\admin\model\Pro as P;

class Pro extends Base
{
	public function index()
	{
		$pro = new P;
		$this->assign('list',$pro->index());
		return $this->fetch();
	}
	
	public function add()
	{
		$pro = new P;
		if(request()->isPost()){
			$pro->add();
			$this->success('数据添加成功','Pro/index');
		}else{
			return $this->fetch();
		}
	}
	
	public function edit()
	{
		$pro = new P;
		if(request()->isPost()){
			$pro->edit();
			$this->success('该条数据修改成功','Pro/index');
		}else{
			$this->assign('info',$pro->show());
			return $this->fetch();
		}
	}
	
	public function del()
	{
		$pro = new P;
		if($pro->del()){
			$this->success('改条数据删除成功','Pro/index');
		};
	}
}