<?php
namespace app\api\controller;

use think\Db;
use think\Request;
use think\controller\Rest;

header('Access-Control-Allow-Origin:*');
class Pro extends Rest
{
    /*产品列表*/
    public function proList($id)
    {
        $id = Request::instance()->param();
        $join = [
            ['agent ag','a.agent_id = ag.id'],
        ];
        $discount = findone('user',$join,'ag.discount',['a.id'=>$id['id']]);
        $pro = findMore('pro',[],'id,title,price,banner,des','','','');
        if($pro){
            foreach($pro as $v){
                $v['price'] = round($v['price']* ($discount['discount']/100),2);;
                $pro1[]  = $v;
            }
            if ($pro1) {
                echo json(200,$pro1);
            } else {
                echo json(202, '');
            }
        }else{
            echo json(404, '');
        }
    }
    /*产品详情*/
    public function proDes($id)
    {
        $id = json_decode(Request::instance()->param()['id'],true);
        $join = [
            ['agent ag','a.agent_id = ag.id'],
        ];
        $discount = findone('user',$join,'ag.discount',['a.id'=>$id['user_id']]);
        $pro = findone('pro',[],'id,title,price,banner,content,des',['id'=>$id['pro_id']]);
        if($pro){
            $pro['price'] = round($pro['price']* ($discount['discount']/100),2);
            if ($pro) {
                echo json(200,$pro);
            } else {
                echo json(202, '');
            }
        }else{
            echo json(404, '');
        }
    }
    /*下单入库*/
    public function proOrder()
    {
        $data = Request::instance()->param();
        $money = findone('user',[],'money,pid',['id'=>$data['user_id']]);
        if($money['money'] > 0.1){
            $data['number'] = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
            $data['pid'] = $money['pid'];
            $insert = addId('order',$data);
            if($insert){
                echo json(200,$insert);
            }else{
                echo json(202, '');
            }
        }else{
            echo json(422, '');
        }

    }
    /*订单详情*/
    public function goodsInfo($id)
    {
        $order = findone('order',[],'id,number,pro,num,total,logistics_static,create_time,pay',['id'=>$id]);
        if($order){
            echo json(200,$order);
        }else{
            echo json(404, '');
        }
    }
    /*地址详情*/
    public function addressInfo($id)
    {
        $order = findone('address',[],'id,name,phone,address',['id'=>$id]);
        if($order){
            echo json(200,$order);
        }else{
            echo json(404, '');
        }
    }
    /*去支付*/
    public function pay($id){
        Db::startTrans();
        $pro = findone('order',[],'total,user_id',['id'=>$id]);
        $price = $pro['total'];
        $money = findone('user',[],'money',['id'=>$pro['user_id']]);
        if($money['money'] > $price){
            $result = Db::execute('update fen_user set money = money - '.$price.' where id = '.$pro['user_id']);
            if($result){
                $data = [
                    'user_id'=>$pro['user_id'],
                    'event'=>'购买商品:支出'.$price.'元',
                    'money'=>$price,
                    'create_time'=>date('Y-m-d : H:i:s')
                ];
                $insert = addId('transaction',$data);
                edit("order",['id'=>$id],['pay'=>1]);
                if($insert){
                    Db::commit();
                    echo json(200,'');
                }else{
                    Db::rollback();
                    echo json(304,'');
                }
            }else{
                Db::rollback();
                echo json(304,'');
            }
        }else{
            Db::rollback();
            echo json(422,'');
        }
    }
    /* 微信支付完成，回调地址url方法  */
    public function wxSpeech(){
        $post = $_REQUEST;    //接受POST数据XML个数
        if($post==null){
            $post = file_get_contents("php://input");
        }
        $post_data = $this->xml_to_array($post);   //微信支付成功，返回回调地址url的数据：XML转数组Array
        $postSign = $post_data['sign'];
        unset($post_data['sign']);

        /* 微信官方提醒：
         *  商户系统对于支付结果通知的内容一定要做【签名验证】,
         *  并校验返回的【订单金额是否与商户侧的订单金额】一致，
         *  防止数据泄漏导致出现“假通知”，造成资金损失。
         */
        ksort($post_data);// 对数据进行排序
        $str = $this->ToUrlParams($post_data);//对数组数据拼接成key=value字符串
        $user_sign = strtoupper(md5($post_data));   //再次生成签名，与$postSign比较


        $order_status = findone('order',[],'status,user_id,price',['number'=>$post_data['out_trade_no']]);
        if($post_data['return_code']=='SUCCESS'&&$postSign){
            edit("order",['number'=>$post_data['out_trade_no']],['pay'=>1]);
            $data = [
                'user_id'=>$order_status['user_id'],
                'event'=>'购买商品:支出'.$order_status['price'].'元',
                'money'=>$order_status['price'],
                'create_time'=>date('Y-m-d : H:i:s')
            ];
            $insert = addId('transaction',$data);
            /*
            * 首先判断，订单是否已经更新为ok，因为微信会总共发送8次回调确认
            * 其次，订单已经为ok的，直接返回SUCCESS
            * 最后，订单没有为ok的，更新状态为ok，返回SUCCESS
            */
            if($order_status['status'] == 1){
                $this->return_success();
            }else{
                if(edit("order",['number'=>$post_data['out_trade_no']],['status'=>1])){
                    $this->return_success();
                }
            }
        }else{
            echo '微信支付失败';
        }
    }
    /* 微信充值完成，回调地址url方法  */
    public function chongzhi(){
        $post = $_REQUEST;    //接受POST数据XML个数
        if($post==null){
            $post = file_get_contents("php://input");
        }
        $post_data = $this->xml_to_array($post);   //微信支付成功，返回回调地址url的数据：XML转数组Array
        $postSign = $post_data['sign'];
        unset($post_data['sign']);

        /* 微信官方提醒：
         *  商户系统对于支付结果通知的内容一定要做【签名验证】,
         *  并校验返回的【订单金额是否与商户侧的订单金额】一致，
         *  防止数据泄漏导致出现“假通知”，造成资金损失。
         */
        ksort($post_data);// 对数据进行排序
        $str = $this->ToUrlParams($post_data);//对数组数据拼接成key=value字符串
        $user_sign = strtoupper(md5($post_data));   //再次生成签名，与$postSign比较


        if($post_data['return_code']=='SUCCESS'&&$postSign){

            $this->return_success();

        }else{
            echo '微信支付失败';
        }
    }
    //获取xml里面数据，转换成array
    private function xml_to_array($xml){
        $p = xml_parser_create();
        xml_parse_into_struct($p, $xml, $vals, $index);
        xml_parser_free($p);
        $data = "";
        foreach ($index as $key=>$value) {
            if($key == 'xml' || $key == 'XML') continue;
            $tag = $vals[$value[0]]['tag'];
            $value = $vals[$value[0]]['value'];
            $data[$tag] = $value;
        }
        return $data;
    }
    /**
     * 将参数拼接为url: key=value&key=value
     * @param $params
     * @return string
     */
    public function ToUrlParams( $params ){
        $string = '';
        if( !empty($params) ){
            $array = array();
            foreach( $params as $key => $value ){
                $array[] = $key.'='.$value;
            }
            $string = implode("&",$array);
        }
        return $string;
    }

    /*
     * 给微信发送确认订单金额和签名正确，SUCCESS信息 -xzz0521
     */
    private function return_success(){
        $return['return_code'] = 'SUCCESS';
        $return['return_msg'] = 'OK';
        $xml_post = '<xml>
                <return_code>'.$return['return_code'].'</return_code>
                <return_msg>'.$return['return_msg'].'</return_msg>
                </xml>';
        echo $xml_post;exit;
    }


}
