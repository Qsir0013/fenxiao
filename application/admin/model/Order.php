<?php
namespace app\admin\model;

use think\Model;

class Order extends Model
{
    public function index()
    {
		$join = [
			['user u','a.user_id = u.id'],
			['pro p','a.pro = p.id']
		];
		$data = findMorePg('order',$join,'a.id,number,p.title,a.num,username,total,a.create_time,is_delete','a.id',['logistics_static'=>1],'create_time desc',10);
		$data = isset($data)&&!empty($data)?$data:'';
		return $data;
    }
	
	public function un()
    {
		$join = [
			['user u','a.user_id = u.id'],
			['pro p','a.pro = p.id']
		];
		$data = findMorePg('order',$join,'a.id,number,p.title,a.num,username,total,a.create_time,is_delete','a.id',['logistics_static'=>0],'create_time desc',10);
		$data = isset($data)&&!empty($data)?$data:'';
		return $data;
    }
	
	public function edit()
	{
		$data = $_POST;
		$data['logistics_static'] = 1;
		edit('order',['id'=>input('id')],$data);
	}
	
	public function show()
	{
		$join = [
			['user u','a.user_id = u.id'],
			['pro p','a.pro = p.id'],
			['address ad','a.address_id = ad.id']
		];
		$data = findone('order',$join,'a.id,number,p.title,a.num,static,username,total,a.create_time,is_delete,ad.name,ad.phone,address',['a.id'=>input('id')]);
		return $data;
	}
}