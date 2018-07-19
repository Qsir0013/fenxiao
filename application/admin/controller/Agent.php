<?php
namespace app\admin\controller;

class Agent extends Base
{
	public function index()
	{
		return $this->fetch();
	}
}