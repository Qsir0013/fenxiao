<?php
namespace app\api\controller;

use think\Session;
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
        header('content-type:image/gif');
        //header('content-type:image/png');格式自选，不同格式貌似加载速度略有不同，想加载更快可选择jpg
        //header('content-type:image/jpg');
        $uid = 6;//参数
        $data = array();
        $data['scene'] = "uid=" . $uid;
        $data['page'] = "pages/index/index";
        $data = json_encode($data);
        $access_token = wxToken();
        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $access_token;
        $this->get_http_array($url,$data);
        //这里强调显示二维码可以直接写该访问路径，同时也可以使用curl保存到本地，详细用法可以加群或者加我扣扣
    }
    public function get_http_array($url,$post_data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   //没有这个会自动输出，不用print_r();也会在后面多个1
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        $out = json_decode($output);
        return $out;
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
                    echo json(200,['index'=>1]);
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
                    echo json(200,['index'=>0]);
                }else{
                    echo json(202,'');
                }
            }
        }else{//扫码进入
            $code = $data['code'];
            $openid = openId($code);
            $data['openid'] = $openid;
            $find = findone('user',[],'id,username',['openid'=>$openid]);
            if($find){
                echo json(200,['index'=>2,'p_id'=>$data['p_id'],'r_id'=>$data['r_id']]);
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
                    echo json(200,['index'=>2,'p_id'=>$data['p_id'],'r_id'=>$data['r_id']]);
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
            echo json(200, '');
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
