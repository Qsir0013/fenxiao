<?php
namespace app\admin\controller;

use app\admin\model\Order as O;

class Order extends Base
{
	public function index()
	{
		$order = new O;
		$this->assign('list',$order->index());
		return $this->fetch();
	}
	
	public function un()
	{
		$order = new O;
		$this->assign('list',$order->un());
		return $this->fetch();
	}
	
	public function edit()
	{
		$order = new O;
		if(request()->isPost()){
			$order->edit();
			$this->success('该条数据修改成功','Order/index');
		}else{
			$this->assign(['info'=>$order->show()]);
			return $this->fetch();
		}
	}
	
	public function show()
	{
		$order = new O;
		$this->assign(['info'=>$order->show()]);
		return $this->fetch();
	}
}