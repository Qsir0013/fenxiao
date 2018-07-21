<?php
namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
	public function _initialize()
	{
		if(session('A')===NULL){
			$this->success('您还未登录！','Login/index');
		}
	}
}