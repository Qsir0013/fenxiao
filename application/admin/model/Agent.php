<?php
namespace app\admin\model;

use think\Model;

class Agent extends Model
{
    public function index()
    {
		$data = findMorePg('agent',[],'*','id','','discount ',10);
		$data = isset($data)&&!empty($data)?$data:'';
		return $data;
    }
	
	public function add()
	{
		$data = $_POST;
		if(checkData('Agent',$data,'')){
			addData('agent',$data);
		}
	}
	
	public function del()
	{
		$del = del('agent',['id'=>input('id')]);
		if($del){
			return true;
		}else{
			msgback('删除异常！');
		}
	}
	
	public function edit()
	{
		$data = $_POST;
		if(checkData('Agent',$data,'edit')){
			edit('agent',['id'=>input('id')],$data);
		}
	}
	
	public function show()
	{
		$data = findone('agent',[],'name,discount',['id'=>input('id')]);
		return $data;
	}
}