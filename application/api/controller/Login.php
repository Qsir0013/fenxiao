<?php
namespace app\api\controller;

use think\Session;
use think\Loader;
use think\Request;
use think\controller\Rest;

header('Access-Control-Allow-Origin:*');

class Login extends Rest
{
    public function rest()
    {
        switch ($this->method){
            case 'get':     //获取页面信息
                $this->index($id);
                break;
        }
    }

    /*获取上级用户信息*/
    public function higher($id){
        $id = Request::instance()->param();
        $join = [
            ['agent ag','a.agent_id = ag.id']
        ];
        $find = findone('user',$join,'a.username,a.img,ag.name',['a.id'=>$id['id']]);
        if ($find) {
            echo json(200,$find);
        } else {
            echo json(202, '');
        }
    }
    /*获取分销代理名称*/
    public function agent($id)
    {
        $id = Request::instance()->param();
        $find = findone('agent',[],'id,name',['id'=>$id['id']]);
        if ($find) {
            echo json(200,$find);
        } else {
            echo json(202, '');
        }
    }
    /*获取所有分销代理名称*/
    public function allAgent()
    {
        $find = findMore('agent',[],'id,name','','','');;
        if ($find) {
            echo json(200,$find);
        } else {
            echo json(202, '');
        }
    }


    //获得二维码
    public function get_qrcode($id) {
        $data = json_decode(Request::instance()->param()['id'],true);
        $token = wxToken();
        $url="https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=".$token;
        $post_data=
            array(
                'page'=>'pages/registered/registered',
                'scene'=>$data['scene']
            );
        $post_data=json_encode($post_data);
        $data=$this->send_post($url,$post_data);
        $result=$this->data_uri($data,'image/png');
        return $result;
    }

    //二进制转图片image/png
    public function data_uri($contents, $mime)
    {
        $base64   = base64_encode($contents);
        return ('data:' . $mime . ';base64,' . $base64);
    }
    protected function send_post( $url, $post_data ) {
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-type:application/json',
                //header 需要设置为 JSON
                'content' => $post_data,
                'timeout' => 60
                //超时时间
            )
        );
        $context = stream_context_create( $options );
        $result = file_get_contents( $url, false, $context );
        return $result;
    }
    /*分销首页*/
    public function index()
    {
        $data = $_GET;
        if (empty($data['p_id']) && empty($data['r_id'])) {//直接进入
            $code = $data['code'];
            $openid = openId($code);
            $find = findone('user',[],'id,username',['openid'=>$openid]);
            if($find){
                if($find['username']){
                    echo json(200,['index'=>1,'user_id'=>$find['id']]);
                }else{
                    echo json(200,['index'=>0]);
                }
            }else{
                $arr['openid'] = $openid;
                $nick = $_GET['nick'];
                $imgUrl = $_GET['avaurl'];
                $sex = $_GET['sex'];
                $arr['wxname'] = $nick;
                $arr['img'] = $imgUrl;
                $arr['sex'] = $sex;
                $insert = addId('user', $arr);
                if($insert){
                    echo json(200,['index'=>0,'user_id'=>$insert]);
                }else{
                    echo json(202,'');
                }
            }
        }else{//扫码进入
            $code = $data['code'];
            $data['scene'] = "1&2";
            $a = explode("&",$data['scene']);
            $user_id = $a[0];
            $level = $a[1];
            $openid = openId($code);
            $data['openid'] = $openid;
            $find = findone('user',[],'id,username',['openid'=>$openid]);
            if($find){
                echo json(200,['index'=>2,'p_id'=>$user_id,'r_id'=>$level,'user_id'=>$find['id']]);
            }else{
                $arr['openid'] = $openid;
                $nick = $_GET['nick'];
                $imgUrl = $_GET['avaurl'];
                $sex = $_GET['sex'];
                $arr['wxname'] = $nick;
                $arr['img'] = $imgUrl;
                $arr['sex'] = $sex;
                $insert = addId('user', $arr);
                if($insert){
                    echo json(200,['index'=>2,'p_id'=>$user_id,'r_id'=>$level,'user_id'=>$insert]);
                }else{
                    echo json(202,'');
                }
            }
        }
    }
    /*注册代理商*/
    public function insertAgent(){
        $data = Request::instance()->param();
        $data['create_time'] = date('Y-m-d : H:i:s');
        $address = $data['address'];
        unset($data['address']);
        $insert = addId('user', $data);
        $addressArr = [
            'user_id'=>$insert,
            'name'=>$data['username'],
            'phone'=>$data['phone'],
            'address'=>$address,
            'create_time'=>date('Y-m-d : H:i:s')
        ];
        $insert1 = addId('address', $addressArr);
        if ($insert && $insert1) {
            echo json(200, ['user_id'=>$insert]);
        } else {
            echo json(202, '');
        }
    }
    /*上级审核通过*/
    public function pass($id){
        $data = json_decode(Request::instance()->param()['id'],true);
        $join = [
            ['agent ag','a.agent_id = ag.id'],
        ];
        $order1 = findone('user',$join,'a.id as user_id,ag.id as agent_id',['a.id'=>$data['user_id']]);//当前用户
        $order2 = findone('user',$join,'ag.id as agent_id',['a.id'=>$data['auditing_id']]);//被审核者
        if($order1['agent_id'] == 2 && $order2['agent_id'] != $order1['agent_id']){ //如果当前用户是一级代理且被审核者跟自己不是同一级 则不能再发展下线
            echo json(404,"");
        }else{
            $edit = edit('user',['id'=>$data['auditing_id']],['static'=>1]);
            if ($edit) {
                echo json(200,"");
            }else{
                echo json(304,"");
            }
        }

    }
    /*上级拒绝审核*/
    public function out($id){
        $id = Request::instance()->param();
        $edit = edit('user',['id'=>$id['id']],['static'=>0]);
        if ($edit) {
            echo json(200,"");
        }else{
            echo json(304,"");
        }
    }
}
