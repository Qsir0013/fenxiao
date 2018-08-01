<?php
namespace app\api\controller;

use think\db;
use think\Request;
use think\controller\Rest;

header('Access-Control-Allow-Origin:*');
class User extends Rest
{
    /*个人信息*/
    public function infoPerson($id)
    {
        $id = Request::instance()->param();
        $join = [
            ['agent ag','a.agent_id = ag.id'],
        ];
        $find = findone('user',$join,'a.username,ag.name,a.idcode,a.weicode,a.phone,a.static',['a.id'=>$id['id']]);
        if ($find) {
            echo json(200,$find);
        } else {
            echo json(202, '');
        }
    }
    /*个人账单明细*/
    public function detail($id)
    {
        $select = findMore('transaction',[],'* ',['user_id'=>$id],'','');
        if($select){
            echo json(200,$select);
        }else{
            echo json(202,'');
        }
    }
    /*个人地址*/
    public function address($id)
    {
        $select = findMore('address',[],'id,name,phone,address',['user_id'=>$id],'','');
        if($select){
            echo json(200,$select);
        }else{
            echo json(404,'');
        }
    }
    /*个人订单*/
    public function order($id){
        $select = findMore('order',[],'id,number,pro,num,total,logistics_static,create_time,is_delete,pay',['user_id'=>$id],'id desc','');
        if($select){
            foreach($select as $k =>$item){
                $select_pro = findone('pro',[],'title,price,banner,content',['id'=>$item['pro']]);
                $item['pro_item'] = $select_pro;
                $data[] = $item;
            }
            if($data){
                echo json(200,$data);
            }else{
                echo json(404,'');
            }
        }else{
            echo json(404,'');
        }

    }
    /*我的授权信息*/
    public function authorize($id)
    {
        $id = Request::instance()->param();
        $join = [
            ['agent ag','a.agent_id = ag.id'],
        ];
        $find = findone('user',$join,'a.username,ag.name',['a.id'=>$id['id']]);
        if ($find) {
            echo json(200,$find);
        } else {
            echo json(404, '');
        }
    }
    /*修改个人信息*/
    public function editInfo()
    {
        $data = Request::instance()->param();
        $data['id'] = $data['user_id'];
        unset($data['user_id']);
        $edit = edit('user',['id'=>$data['id']],$data);
        if($edit){
            echo json(200,'');
        } else {
            echo json(202, '');
        }
    }

}
