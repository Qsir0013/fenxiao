<?php
namespace app\api\controller;

use think\Request;
use think\controller\Rest;

header('Access-Control-Allow-Origin:*');
class Address extends Rest
{
    public function rest()
    {
        switch ($this->method){
            case 'post':    //新增
                $this->addressAdd();
                break;
            case 'put':  //修改
                $this->addressEdit($id);
                break;
            case 'delete':  //修改
                $this->addressDelete($id);
                break;
        }
    }
    /*地址增加*/
    public function addressAdd()
    {
        $data = Request::instance()->param();
        $data['create_time'] = date('Y-m-d:H:i:s');
        $insert = addData('address',$data);
        if($insert){
            echo json(200,$data['name']);
        }else{
            echo json(202,'');
        }
    }
    /*地址修改*/
    public function addressEdit($id)
    {
        $data = json_decode(Request::instance()->param()['id'],true);
        $edit = edit('address',['id'=>$data['id']],$data);
        if($edit){
            echo json(200,'');
        }else{
            echo json(202,'');
        }
    }
    /*地址删除*/
    public function addressDelete($id){
        $id = Request::instance()->param();
        $delete = del('address',['id'=>$id['id']]);
        if($delete){
            echo json(200,'');
        }else{
            echo json(202,'');
        }
    }

}
