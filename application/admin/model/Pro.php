<?php
namespace app\admin\model;

use think\Model;

class Pro extends Model
{
    public function index()
    {
		$data = findMorePg('pro',[],'*','id','','create_time desc',10);
		$data = isset($data)&&!empty($data)?$data:'';
		return $data;
    }
	
	public function add()
	{
		$data = $_POST;
		if($_FILES['banner']['name']!=''){			
			$data['banner'] = upFile('banner');
		}else{
			$data['banner'] = '';
		}
		if($_FILES['content']['name']!=''){			
			$data['content'] = upFile('content');
		}else{
			$data['content'] = '';
		}
		if(checkData('Pro',$data,'')){
			addData('pro',$data);
		}
	}
	
	public function del()
	{
		$pro = findone('pro',[],'banner,content',['id'=>input('id')]);
		$src = ROOT_PATH . 'public' . DS . 'uploads'. DS ;
		$banner = unlink($src.$pro['banner']);
		$content = unlink($src.$pro['content']);
		$del = del('pro',['id'=>input('id')]);
		if($banner&&$content&&$del){
			return true;
		}else{
			msgback('删除异常！');
		}
	}
	
	public function edit()
	{
		$data = $_POST;
		if($_FILES['banner']['name']!=''){			
			$data['banner'] = upFile('banner');
		}else{
			$data['banner'] = $_POST['banner'];
		}
		if($_FILES['content']['name']!=''){			
			$data['content'] = upFile('content');
		}else{
			$data['content'] = $_POST['content'];
		}
		if(checkData('Pro',$data,'edit')){
			edit('pro',['id'=>input('id')],$data);
		}
	}
	
	public function show()
	{
		$pro = findone('pro',[],'title,price,banner,des,content',['id'=>input('id')]);
		return $pro;
	}
}