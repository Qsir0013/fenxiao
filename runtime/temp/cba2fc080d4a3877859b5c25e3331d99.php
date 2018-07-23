<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"D:\php\PHPTutorial\WWW\llll\public/../application/admin\view\order\edit.html";i:1532169102;s:69:"D:\php\PHPTutorial\WWW\llll\application\admin\view\public\header.html";i:1532166178;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
<base href="/static/admin/"/>
<title>后台管理</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/fullcalendar.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="css/jquery.gritter.css" />
<style>
.pagination{text-align:center;margin-top:20px;margin-bottom: 20px;}
.pagination li{margin:0px 10px; border:1px solid #e6e6e6;padding: 3px 8px;display: inline-block;}
.pagination .active{background-color: #dd1a20;color: #fff;}
.pagination .disabled{color:#aaa;}
</style>
</head>
<body>
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html"></a></h1>
</div>
<!--close-Header-part--> 
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">欢迎您： <?php echo \think\Session::get('A')['username']; ?></span><b class="caret"></b></a>
    </li>
    <li class=""><a title="" href="<?php echo url('Login/cinfo'); ?>"><i class="icon icon-cog"></i> <span class="text">信息设置</span></a></li>
    <li class=""><a title="" href="<?php echo url('Login/singOut'); ?>"><i class="icon icon-share-alt"></i> <span class="text">退出</span></a></li>
	<li class=""><a title="" > <span class="text">您上次登陆时间：<?php echo \think\Session::get('A')['login_time']; ?></span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--sidebar-menu-->
  <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 仪表板</font></font></a>
  <ul style="display: block;">
    <li> <a href="<?php echo url('Pro/index'); ?>"><i class="icon icon-leaf"></i> <span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">产品管理</font></font></span></a> </li>
	<li> <a href="<?php echo url('Agent/index'); ?>"><i class="icon icon-sitemap"></i> <span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">代理设置</font></font></span></a> </li>
	<li> <a href="<?php echo url('User/index'); ?>"><i class="icon icon-user"></i> <span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户管理</font></font></span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">订单管理</font></font></span> </a>
      <ul>
        <li><a href="<?php echo url('Order/index'); ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">已发货</font></font></a></li>
        <li><a href="<?php echo url('Order/un'); ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">未发货</font></font></a></li>
        
      </ul>
	</li>
  </ul>
</div>
</div>

	<div id="content">
	<div class="container-fluid">
	<div class="row-fluid">
	<div class="span6">
	
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">修改用户数据</font></font></h5>
        </div>
        <div class="widget-content nopadding">
		   
          <form action="" method="post" class="form-horizontal" >
			
            <div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">订单号 ：</font></font></label>
              <div class="controls">
                <input  type="text" name="number" value="<?php echo $info['number']; ?>" class="span11" placeholder="微信昵称">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">产品 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" value="<?php echo $info['title']; ?>" class="span11" placeholder="性别">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">数量 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="num" value="<?php echo $info['num']; ?>" class="span11" placeholder="openid">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户姓名 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" value="<?php echo $info['username']; ?>" class="span11" placeholder="用户姓名">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">总价 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="total" value="<?php echo $info['total']; ?>" class="span11" placeholder="手机号">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">审核状态 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="static" 
					<?php switch($info['is_delete']): case "0": ?> value="未通过"<?php break; case "1": ?> value="通过"<?php break; case "2": ?> value="审核中"<?php break; endswitch; ?>
				class="span11" placeholder="">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">收货人姓名 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" value="<?php echo $info['name']; ?>" class="span11" placeholder="微信号">
              </div>
            </div>
			

			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">收货人电话 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="phone" value="<?php echo $info['phone']; ?>" class="span11" placeholder="余额">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">收货地址 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" value="<?php echo $info['address']; ?>" class="span11" placeholder="返现金额">
              </div>
            </div>

			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">下单时间 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="create_time" value="<?php echo $info['create_time']; ?>" class="span11" placeholder="代理角色名称">
              </div>
            </div>
			
            <div class="form-actions">
              <button type="submit" class="btn btn-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">保存</font></font></button>
            </div>
          </form>
        </div>
      </div>
      
      
    </div>

	</div>
	</div>
	</div>
<script src="js/excanvas.min.js"></script> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flot.min.js"></script> 
<script src="js/jquery.flot.resize.min.js"></script> 
<script src="js/jquery.peity.min.js"></script> 
<script src="js/fullcalendar.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.dashboard.js"></script> 
<script src="js/jquery.gritter.min.js"></script> 
<script src="js/matrix.chat.js"></script> 
<script src="js/jquery.validate.js"></script> 
<script src="js/matrix.form_validation.js"></script> 
<script src="js/jquery.wizard.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.popover.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script> 
</body>
</html>
