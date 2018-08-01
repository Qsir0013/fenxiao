<?php
namespace app\api\controller;

use think\Db;
use think\Request;
use think\controller\Rest;

header('Access-Control-Allow-Origin:*');
class Wx extends Rest
{
    //微信支付
    public function Wx_Pay(){
        $request=Request::instance();
        $fee=$request->param('total');
        $details=$request->param('content');//商品的名称
        $program = config('pay');
        $appid =        $program['app_id'];//appid
        $body =        $details;// '商品信息';//'【自己填写】'
        $mch_id =       $program['mch_id'];//'你的商户号【自己填写】'
        $nonce_str =    $this->nonce_str();//随机字符串
        $notify_url =   'http://www.fen.com/wxSpeech';//回调的url【自己填写】';
        $openid =       openId($request->param('code'));//'用户的openid【自己填写】';
        $out_trade_no = $request->param('number');//商户订单号
        $spbill_create_ip = '118.190.210.33';//'服务器的ip【自己填写】';
        $total_fee =    $fee*100;//因为充值金额最小是1 而且单位为分 如果是充值1元所以这里需要*100
        $trade_type = 'JSAPI';//交易类型 默认
        //这里是按照顺序的 因为下面的签名是按照顺序 排序错误 肯定出错
        $post['appid'] = $appid;
        $post['body'] = $body;

        $post['mch_id'] = $mch_id;

        $post['nonce_str'] = $nonce_str;//随机字符串

        $post['notify_url'] = $notify_url;

        $post['openid'] = $openid;

        $post['out_trade_no'] = $out_trade_no;

        $post['spbill_create_ip'] = $spbill_create_ip;//终端的ip

        $post['total_fee'] = $total_fee;//总金额 最低为一块钱 必须是整数

        $post['trade_type'] = $trade_type;
        $sign = $this->sign($post);//签名
        $post_xml = '<xml>
                        <appid>'.$appid.'</appid>
                        <body>'.$body.'</body>
                        <mch_id>'.$mch_id.'</mch_id>
                        <nonce_str>'.$nonce_str.'</nonce_str>
                        <notify_url>'.$notify_url.'</notify_url>
                        <openid>'.$openid.'</openid>
                        <out_trade_no>'.$out_trade_no.'</out_trade_no>
                        <spbill_create_ip>'.$spbill_create_ip.'</spbill_create_ip>
                        <total_fee>'.$total_fee.'</total_fee>
                        <trade_type>'.$trade_type.'</trade_type>
                        <sign>'.$sign.'</sign>
                    </xml> ';
        //统一接口prepay_id
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $xml = postXmlCurl($post_xml,$url);
        $array = $this->xml($xml);//全要大写
        if($array['RETURN_CODE'] == 'SUCCESS' && $array['RESULT_CODE'] == 'SUCCESS'){
            $time = time();
            $tmp=[];//临时数组用于签名
            $tmp['appId'] = $appid;
            $tmp['nonceStr'] = $nonce_str;
            $tmp['package'] = 'prepay_id='.$array['PREPAY_ID'];
            $tmp['signType'] = 'MD5';
            $tmp['timeStamp'] = "$time";

            $data = [];
            $data['appId'] = $appid;
            $data['timeStamp'] = "$time";//时间戳
            $data['nonceStr'] = $nonce_str;//随机字符串
            $data['signType'] = 'MD5';//签名算法，暂支持 MD5
            $data['package'] = 'prepay_id='.$array['PREPAY_ID'];//统一下单接口返回的 prepay_id 参数值，提交格式如：prepay_id=*
            $data['paySign'] = $this->sign($tmp);//签名,具体签名方案参见微信公众号支付帮助文档;
            $data['out_trade_no'] = $out_trade_no;
            echo json_encode($data,true);
        }else{
            $info = [];
            if($array['RETURN_CODE'] == 'FAIL'){
                $info['return_msg'] = $array['RETURN_MSG'];
            }
            echo json_encode($info,true);
        }
    }
    //微信充值
    public function Wx_Chongzhi(){
        $request=Request::instance();
        $fee=$request->param('total');
        $details= $request->param('user_id');//商品的名称
        $program = config('pay');
        $appid =        $program['app_id'];//appid
        $body =        $details;// '商品信息';//'【自己填写】'
        $mch_id =       $program['mch_id'];//'你的商户号【自己填写】'
        $nonce_str =    $this->nonce_str();//随机字符串
        $notify_url =   'http://www.fen.com/chongzhi';//回调的url【自己填写】';
        $openid =       openId($request->param('code'));//'用户的openid【自己填写】';
        $out_trade_no = $this->nonce_str();//商户订单号
        $spbill_create_ip = '118.190.210.33';//'服务器的ip【自己填写】';
        $total_fee =    $fee*100;//因为充值金额最小是1 而且单位为分 如果是充值1元所以这里需要*100
        $trade_type = 'JSAPI';//交易类型 默认
        //这里是按照顺序的 因为下面的签名是按照顺序 排序错误 肯定出错
        $post['appid'] = $appid;
        $post['body'] = $body;

        $post['mch_id'] = $mch_id;

        $post['nonce_str'] = $nonce_str;//随机字符串

        $post['notify_url'] = $notify_url;

        $post['openid'] = $openid;

        $post['out_trade_no'] = $out_trade_no;

        $post['spbill_create_ip'] = $spbill_create_ip;//终端的ip

        $post['total_fee'] = $total_fee;//总金额 最低为一块钱 必须是整数

        $post['trade_type'] = $trade_type;
        $sign = $this->sign($post);//签名
        $post_xml = '<xml>
                        <appid>'.$appid.'</appid>
                        <body>'.$body.'</body>
                        <mch_id>'.$mch_id.'</mch_id>
                        <nonce_str>'.$nonce_str.'</nonce_str>
                        <notify_url>'.$notify_url.'</notify_url>
                        <openid>'.$openid.'</openid>
                        <out_trade_no>'.$out_trade_no.'</out_trade_no>
                        <spbill_create_ip>'.$spbill_create_ip.'</spbill_create_ip>
                        <total_fee>'.$total_fee.'</total_fee>
                        <trade_type>'.$trade_type.'</trade_type>
                        <sign>'.$sign.'</sign>
                    </xml> ';
        //统一接口prepay_id
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $xml = postXmlCurl($post_xml,$url);
        $array = $this->xml($xml);//全要大写
        if($array['RETURN_CODE'] == 'SUCCESS' && $array['RESULT_CODE'] == 'SUCCESS'){
            $result = Db::execute('update fen_user set money = money + '.$fee.' where id = '.$request->param('user_id'));
            /*
            * 首先判断，订单是否已经更新为ok，因为微信会总共发送8次回调确认
            * 其次，订单已经为ok的，直接返回SUCCESS
            * 最后，订单没有为ok的，更新状态为ok，返回SUCCESS
            */
            if($result){
                $data = [
                    'user_id'=>$request->param('user_id'),
                    'event'=>'充值:充值'.$fee.'元',
                    'money'=>$fee,
                    'create_time'=>date('Y-m-d : H:i:s')
                ];
                addId('transaction',$data);
            }
            $time = time();
            $tmp=[];//临时数组用于签名
            $tmp['appId'] = $appid;
            $tmp['nonceStr'] = $nonce_str;
            $tmp['package'] = 'prepay_id='.$array['PREPAY_ID'];
            $tmp['signType'] = 'MD5';
            $tmp['timeStamp'] = "$time";

            $data = [];
            $data['appId'] = $appid;
            $data['timeStamp'] = "$time";//时间戳
            $data['nonceStr'] = $nonce_str;//随机字符串
            $data['signType'] = 'MD5';//签名算法，暂支持 MD5
            $data['package'] = 'prepay_id='.$array['PREPAY_ID'];//统一下单接口返回的 prepay_id 参数值，提交格式如：prepay_id=*
            $data['paySign'] = $this->sign($tmp);//签名,具体签名方案参见微信公众号支付帮助文档;
            $data['out_trade_no'] = $out_trade_no;
            echo json_encode($data,true);
        }else{
            $info = [];
            if($array['RETURN_CODE'] == 'FAIL'){
                $info['return_msg'] = $array['RETURN_MSG'];
            }
            echo json_encode($info,true);
        }
    }
    //提现
    public function tiXian($id){
        $request = json_decode(Request::instance()->param()['id'],true);
        $program = config('pay');
        $appid = $program['app_id'];//商户账号appid
        $secret = $program['secret'];//api密码
        $mch_id = $program['mch_id'];//商户号
        $openid = openId($request['code']);//授权用户openi
        $arr = array();
        $arr['mch_appid'] = $appid;
        $arr['mchid'] = $mch_id;
        $arr['nonce_str'] = $this->nonce_str();//随机字符串，不长于32位
        $arr['partner_trade_no'] = '1298016501' . date("Ymd") . rand(10000, 90000) . rand(10000, 90000);//商户订单号
        $arr['openid'] = $openid;
        $arr['check_name'] = 'NO_CHECK';//是否验证用户真实姓名，这里不验证
        $arr['amount'] = $request['money']*100;//提现金额，单位为分
        $desc = "返现提现";
        $arr['desc'] = $desc;//描述信息
        $arr['spbill_create_ip'] = '118.190.210.33';//获取服务器的ip
        $arr['sign'] = $this->tixianSign($arr);//签名
        $var = $this->arraytoxml($arr);

        $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers";
        $xml = $this->curl_post_ssl($url,$var);
        $rdata = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        ;
        $return_code = (string)$rdata->return_code;
        $result_code = (string)$rdata->result_code;
        $return_code = trim(strtoupper($return_code));
        $result_code = trim(strtoupper($result_code));

        if ($return_code == 'SUCCESS' && $result_code == 'SUCCESS') {
            Db::startTrans();
            $money = findone("user",[],'balance',['id'=>$request['user_id']]);
            if($money['balance'] < $request['money']){
                $diff = $money['balance']-$request['money'];
                Db::execute('update `fen_user` set balance = 0  where id = '.$request['user_id']);
                $request = Db::execute('update `fen_user` set money = money - '.$diff.' where id = '.$request['user_id']);
            }else{
                $result = Db::execute('update `fen_user` set balance = balance - '.$request['money'].' where id = '.$request['user_id']);
            }
            if($result){
                $data = [
                    'user_id'=>$request['user_id'],
                    'event'=>'提现:提现'.$request['money'].'元',
                    'money'=>$request['money'],
                    'create_time'=>date('Y-m-d : H:i:s')
                ];
                $insert = addId('transaction',$data);
                if($insert){
                    Db::commit();
                    $isrr = array(
                        'con'=>'ok',
                        'error' => 0,
                    );
                }else{
                    Db::rollback();
                    $returnmsg = (string)$rdata->return_msg;
                    $isrr = array(
                        'error' => 1,
                        'errmsg' => $returnmsg,
                    );
                }
            }else{
                Db::rollback();
                $returnmsg = (string)$rdata->return_msg;
                $isrr = array(
                    'error' => 1,
                    'errmsg' => $returnmsg,
                );
            }

        } else {
            $returnmsg = (string)$rdata->return_msg;
            $isrr = array(
                'error' => 1,
                'errmsg' => $returnmsg,
            );

        }
        return json_encode($isrr);
    }
    /*提现签名*/
    function  tixianSign($data){
        //将要发送的数据整理为$data
        ksort($data);//排序
        //使用URL键值对的格式（即key1=value1&key2=value2…）拼接成字符串
        $str='';
        foreach($data as $k=>$v) {
            $str.=$k.'='.$v.'&';
        }
        //拼接API密钥
        $str.='key=Tym13309783900532932198112131526';
        $data['sign']=md5($str);//加密
        return $data['sign'];
    }
    //遍历数组方法
    function arraytoxml($data){
        $str='<xml>';
        foreach($data as $k=>$v) {
            $str.='<'.$k.'>'.$v.'</'.$k.'>';
        }
        $str.='</xml>';
        return $str;
    }
    //随机32位字符串
    private function nonce_str(){
        $result = '';
        $str = 'QWERTYUIOPASDFGHJKLZXVBNMqwertyuioplkjhgfdsamnbvcxz';
        for ($i=0;$i<32;$i++){
            $result .= $str[rand(0,48)];
        }
        return $result;
    }
    //签名 $data要先排好顺序
    public function sign($data)
    {
        $stringA = '';
        foreach ($data as $key => $value) {
            if (!$value) continue;
            if ($stringA) $stringA .= '&' . $key . "=" . $value;
            else $stringA = $key . "=" . $value;
        }
        $wx_key = 'Tym13309783900532932198112131526';//申请支付后有给予一个商户账号和密码，登陆后自己设置key
        $stringSignTemp = $stringA . '&key=' . $wx_key;//申请支付后有给予一个商户账号和密码，登陆后自己设置key
        return strtoupper(md5($stringSignTemp));
    }

    //获取xml
    private function xml($xml){
        $p = xml_parser_create();
        xml_parse_into_struct($p, $xml, $vals, $index);
        xml_parser_free($p);
        $data = [];
        foreach ($index as $key=>$value) {
            if($key == 'xml' || $key == 'XML') continue;
            $tag = $vals[$value[0]]['tag'];
            $value = $vals[$value[0]]['value'];
            $data[$tag] = $value;
        }
        return $data;
    }

    //上个方法中用到的curl_post_ssl()
    function curl_post_ssl($url, $vars, $second = 30, $aHeader = array())
    {
//        $isdir = "../cert/";//证书位置

        $ch = curl_init();//初始化curl
        $path = str_replace("\\","/",dirname(__FILE__));

        curl_setopt($ch, CURLOPT_TIMEOUT, $second);//设置执行最长秒数
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_URL, $url);//抓取指定网页
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// 终止从服务端进行验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//
        curl_setopt($ch, CURLOPT_SSLCERT, $path.'/cert/apiclient_cert.pem');
        curl_setopt($ch, CURLOPT_SSLKEY, $path.'/cert/apiclient_key.pem');
        curl_setopt($ch, CURLOPT_CAINFO, $path.'/cert/rootca.pem');
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');//证书类型
//        curl_setopt($ch, CURLOPT_SSLCERT, $isdir . 'apiclient_cert.pem');//证书位置
        curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');//CURLOPT_SSLKEY中规定的私钥的加密类型
//        curl_setopt($ch, CURLOPT_SSLKEY, $isdir . 'apiclient_key.pem');//证书位置
        curl_setopt($ch, CURLOPT_CAINFO, 'PEM');
//        curl_setopt($ch, CURLOPT_CAINFO, $isdir . 'rootca.pem');
        if (count($aHeader) >= 1) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);//设置头部
        }
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);//全部数据使用HTTP协议中的"POST"操作来发送

        $data = curl_exec($ch);//执行回话
        if ($data) {
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            echo "call faild, errorCode:$error\n";
            curl_close($ch);
            return false;
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
//微信支付结束
}
