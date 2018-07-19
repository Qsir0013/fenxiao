<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Db;
use think\Loader;
use think\config;
use think\Cache;
use think\Request;

function isMobile()
{ 
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
}

//弹出消息
function msgback($msg)
{
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
	echo "<script>alert('$msg');window.location.href=history.go(-1);  </script>";
}

//查询条数
function dataCount($table,$where)
{
	$data = Db::name($table)->where($where)->count();
	if($data){
		return $data;
	}else{
		return 0;
	}
}

//单条查询
function findone($table,$join,$field,$where)
{
	$data = Db::name($table)->alias('a')->join($join)->field($field)->where($where)->find();
	if($data){
		return $data;
	}else{
		return false;
	}
}
 
//多条查询
function findMore($table,$join,$field,$where,$order,$num='')
{
	$data = Db::name($table)->alias('a')->join($join)->field($field)->where($where)->order($order)->limit($num)->select();
	if($data){
		return $data;
	}else{
		return '';
	}
}

//分页
function findMorePg($table,$join,$field,$group,$where,$order,$num)
{
	$data = Db::name($table)->alias('a')->join($join)->field($field)->group($group)->where($where)->order($order)->paginate($num);
	if($data->items()!=array()){
		return $data;
	}else{
		return false;
	}
}

//添加数据
function addData($table,$data)
{
	$data = Db::name($table)->insert($data);
	if($data){
		return $data;
	}else{
		return msg('添加失败！');
	}
}

//递归处理
function getTree($data, $pId)
{
	$tree = array();
	foreach($data as $k => $v)
	{
		if($v['pid'] == $pId)
		{
		$v['cnav'] = getTree($data, $v['id']);
		$tree[] = $v;
		}
	}
		return $tree;
}

//添加数据返回id
function addId($table,$data){
	$data = Db::name($table)->insertGetId($data);
	if($data){
		return $data;
	}else{
		return false;
	}
}

//删除数据
function del($table,$where)
{
	$data = Db::name($table)->where($where)->delete();
	if($data){
		return $data;
	}else{
		return false;
	}
}

//数据修改
function edit($table,$where,$data)
{
	$data = Db::name($table)->where($where)->update($data);
	if($data){
		return $data;
	}else{
		msg('数据修改失败！');
	}
}

//获取数据数量
function num($table,$where)
{
	$data = Db::name($table)->where($where)->count();
	if($data){
		return $data;
	}else{
		return 0;
	}
}

//设置缓存
function setCache($type,$name,$value,$time=0)
{
	return Cache::store($type)->set($name,$value,$time);
}

//获取缓存
function getCache($type,$name)
{
	return Cache::store($type)->get($name);
}

//分组查询
function group($table,$join,$field,$group,$where,$order)
{
	$data = Db::name($table)->alias('a')->join($join)->field($field)->group($group)->where($where)->order($order)->select();
	if($data){
		return $data;
	}else{
		return '';
	}
}

//调用验证
function checkData($val,$data,$scene)
{
	$validate = Loader::validate($val);
	if(!$validate->scene($scene)->check($data)){
		msgback($validate->getError());
	}else{
		return true;
	}
}

//状态码
function code($code)
{
	switch($code){
		case 200:
		return '请求成功！';
		break;
		case 201:
		return '操作成功！';
		break;
		case 204 :
		return '删除成功！';
		break;
		case 304 :
		return '数据未改变！';
		break;
		case 400 :
		return '请求错误！';
		break;
		case 404 :
		return '暂无资源！';
		break;
	}
}

//返回json数据
function json($code,$data)
{
	return json_encode(['code'=>$code,'msg'=>$this->code($code),'res'=>$data]);
}