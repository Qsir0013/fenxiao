<?php
namespace app\admin\model;

use think\Model;

class Login extends Model
{
    public function index()
    {
        $admin = findone('admin',array(),'id,username,login_time',array('username'=>$_POST['username'],'passwd'=>strtoupper(md5($_POST['passwd']))));
		if($admin){
				$data['login_time']=date('Y-m-d H:i:s');
				edit('admin',array('id'=>$admin['id']),$data);
				session('A',$admin);
				return $admin;
		}else{
			msgback('信息错误！');
		}
    }
	
	public function cinfo()
	{
		if(checkData('Cinfo',$_POST,'')){
			$_POST['passwd'] = md5($_POST['passwd']);
			edit('admin',array('id'=>session('A')['id']),$_POST);
			session('A',NULL);
			return true;
		}
	}
}