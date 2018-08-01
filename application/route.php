<?php
use think\Route;

/*栗子*/
//Route::rule('a/','api/Login/a');

/*分销首页*/
Route::post('/insertAgent','api/Login/insertAgent'); //代理提交审核
Route::get('/index','api/Login/index'); //分销首页显示
Route::get('/higher/:id','api/Login/higher'); //上级用户信息显示
Route::get('/agent/:id','api/Login/agent'); //获取单个代理名称
Route::get('/allagent','api/Login/allAgent'); //获取所有代理名称
Route::get('/get_qrcode/:id','api/Login/get_qrcode'); //获取二维码
Route::rule('/pass/:id','api/Login/pass'); //上级通过审核
Route::rule('/out/:id','api/Login/out'); //上级拒绝审核

/*个人中心*/
Route::rule('/infoperson/:id','api/User/infoPerson'); //个人信息
Route::rule('/detail/:id','api/User/detail'); //个人账单
Route::get('/address/:id','api/User/address'); //个人收货地址
Route::rule('/order/:id','api/User/order'); //个人订单列表
Route::rule('/authorize/:id','api/User/authorize'); //我的授权信息
Route::rule('/editinfo','api/User/editInfo'); //我的授权信息

/*团队管理*/
Route::rule('/myAgent/:id','api/Team/myAgent'); //个人信息
Route::rule('/achievement/:id','api/Team/achievement'); //销售业绩
Route::rule('/orderTeam/:id','api/Team/orderTeam'); //团队订单
Route::rule('/auditingOrderd/:id','api/Team/auditingOrderd'); //待审核订单
Route::rule('/confirmAgentd/:id','api/Team/confirmAgentd'); //待确认代理
Route::rule('/auditingOrder/:id','api/Team/auditingOrder'); //审核订单
Route::rule('/outOrder/:id','api/Team/outOrder'); //拒绝审核订单
Route::rule('/orderInfo/:id','api/Team/orderInfo'); //拒绝审核订单
Route::rule('/balance/:id','api/Team/balance'); //余额管理

/*产品*/
Route::rule('/proList/:id','api/Pro/proList'); //产品列表
Route::rule('/proDes/:id','api/Pro/proDes'); //产品详情
Route::post('/proOrder','api/Pro/proOrder'); //下单
Route::rule('/pay/:id','api/Pro/pay'); //钱包余额支付
Route::get('/goodsInfo/:id','api/Pro/goodsInfo'); //产品详情
Route::get('/addressInfo/:id','api/Pro/addressInfo'); //产品详情

/*个人地址增删改查*/
Route::post('/address','api/Address/addressAdd');  //新增
Route::put('/address/:id','api/Address/addressEdit'); //修改
Route::delete('/address/:id','api/Address/addressDelete'); //删除

/*微信支付*/
Route::post('/wxpay','api/Wx/Wx_Pay');  //微信支付
Route::post('/wxchong','api/Wx/Wx_Chongzhi');  //微信充值
Route::post('/wxSpeech','api/Pro/wxSpeech');  //微信支付回调
Route::post('/chongzhi','api/Pro/chongzhi');  //微信充值回调
Route::get('/tixian/:id','api/Wx/tiXian');  //微信提现

