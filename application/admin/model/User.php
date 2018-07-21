<?php
namespace app\admin\model;

use think\Model;

class User extends Model
{
    public function index()
    {
		$join = [
			['agent ag','a.agent_id = ag.id'],
		];
		$data = findMorePg('user',$join,'a.id,img,wxname,username,phone,a.create_time,type,static,name','a.id','','a.create_time desc',10);
		$data = isset($data)&&!empty($data)?$data:'';
		return $data;
    }
	
	public function del()
	{
		$del = del('user',['id'=>input('id')]);
		if($del){
			return true;
		}else{
			msgback('删除异常！');
		}
	}
	
	public function edit()
	{
		$data = $_POST;
		if(checkData('User',$data,'')){
			edit('user',['id'=>input('id')],$data);
		}
	}
	
	public function show()
	{
		$join = [
			['agent ag','a.agent_id = ag.id'],
		];
		
		$data['self'] = findone('user',[],'a.id,a.img,wxname,sex,openid,pid,a.login_time,username,phone,idcode,weicode,type,static,money,balance,a.create_time,agent_id',['a.id'=>input('id')]);
		$data['father'] = findone('user',$join,'username,name',['a.id'=>$data['self']['pid']],'','');
		$data['downline'] = findMore('user',$join,'a.id,img,wxname,username,phone,a.create_time,type,static,name',['pid'=>input('id')],'a.create_time desc','');
		return $data;
	}
	
	public function agent()
	{
		return findMore('agent',[],'id,name','','discount ','');
	}
}