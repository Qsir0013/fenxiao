<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\php\PHPTutorial\WWW\llll\public/../application/admin\view\user\edit.html";i:1532164156;s:69:"D:\php\PHPTutorial\WWW\llll\application\admin\view\public\header.html";i:1532166178;}*/ ?>
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
          <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">该用户的上级</font></font></h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal">
            <div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">上级用户 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" <?php if($info['father']['username'] == ''): ?> value="无上级"<?php else: ?> value="<?php echo $info['father']['username']; ?>"<?php endif; ?>  class="span11" placeholder="上级用户名">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">上级用户角色 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" <?php if($info['father']['name'] == ''): ?> value="无上级"<?php else: ?> value="<?php echo $info['father']['name']; ?>"<?php endif; ?> class="span11" placeholder="上级代理角色">
              </div>
            </div>
          </form>
        </div>
      </div>
	
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">修改用户数据</font></font></h5>
        </div>
        <div class="widget-content nopadding">
		   
          <form action="" method="post" class="form-horizontal" >
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">微信头像 ：</font></font></label>
              <div class="controls">
                <img style="width:50px" <?php if($info['self']['img'] == ''): ?> src="zwt.jpg" <?php else: ?> src="<?php echo $info['self']['img']; ?>" <?php endif; ?>/>
              </div>
            </div>
		  
            <div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">微信昵称 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="wxname" value="<?php echo $info['self']['wxname']; ?>" class="span11" placeholder="微信昵称">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">性别 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="sex" value="<?php echo $info['self']['sex']; ?>" class="span11" placeholder="性别">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">openid ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="openid" value="<?php echo $info['self']['openid']; ?>" class="span11" placeholder="openid">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户姓名 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="username" value="<?php echo $info['self']['username']; ?>" class="span11" placeholder="用户姓名">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">手机号 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="phone" value="<?php echo $info['self']['phone']; ?>" class="span11" placeholder="手机号">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">身份证号 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="idcode" value="<?php echo $info['self']['idcode']; ?>" class="span11" placeholder="身份证号">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">微信号 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="weicode" value="<?php echo $info['self']['weicode']; ?>" class="span11" placeholder="微信号">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户角色 ：</font></font></label>
              <div class="controls">
				<input name="type" value="1" type="radio" <?php if($info['self']['type'] == '1'): ?> checked <?php else: endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;平台管理员<br/><br/>
                <input name="type" value="0" type="radio" <?php if($info['self']['type'] == '0'): ?> checked <?php else: endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;客户
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">核审状态 ：</font></font></label>
              <div class="controls">
				<input name="static"  value="1" type="radio" <?php if($info['self']['static'] == '1'): ?>checked <?php else: endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;通过<br/><br/>
                <input name="static" value="0" type="radio" <?php if($info['self']['static'] == '0'): ?>checked <?php else: endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;拒绝<br/><br/>
				<input name="static" value="2" type="radio" <?php if($info['self']['static'] == '2'): ?> checked <?php else: endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;审核中<br/><br/>
				<input name="static" value="3" type="radio" <?php if($info['self']['static'] == '3'): ?> checked <?php else: endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;未审核<br/><br/>
              </div>
            </div>
			
			
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">余额 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="money" value="<?php echo $info['self']['money']; ?>" class="span11" placeholder="余额">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">返现金额 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="balance" value="<?php echo $info['self']['balance']; ?>" class="span11" placeholder="返现金额">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">代理角色名称 ：</font></font></label>
              <div class="controls">
				<select name="agent_id">
					<?php if(is_array($agent) || $agent instanceof \think\Collection || $agent instanceof \think\Paginator): $i = 0; $__LIST__ = $agent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<option value="<?php echo $vo['id']; ?>" <?php if($info['self']['agent_id'] == $vo['id']): ?>selected <?php else: endif; ?> /><?php echo $vo['name']; endforeach; endif; else: echo "" ;endif; ?>
				</select>
               
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">创建时间 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="create_time" value="<?php echo $info['self']['create_time']; ?>" class="span11" placeholder="代理角色名称">
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">最后登录时间 ：</font></font></label>
              <div class="controls">
                <input disabled type="text" name="login_time" value="<?php echo $info['self']['login_time']; ?>" class="span11" placeholder="代理角色名称">
              </div>
            </div>
			
            <div class="form-actions">
              <button type="submit" class="btn btn-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">保存</font></font></button>
            </div>
          </form>
        </div>
      </div>
      
      
    </div>
	
	<div class="span6">
      <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">下级用户</font></font></h5>
            <a ><span class="label label-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></span> </div></a>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
				  <th style="width:40px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">序号</font></font></th>
                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">头像</font></font></th>
                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">微信昵称</font></font></th>
                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">客户名称</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">客户手机</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">代理角色</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户角色</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">审核状态</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">注册时间</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">操作</font></font></th>
                </tr>
              </thead>
              <tbody>
				<?php if(is_array($info['downline']) || $info['downline'] instanceof \think\Collection || $info['downline'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['downline'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
				  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $vo['id']; ?></font></font></td>
                  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $vo['img']; ?></font></font></td>
                  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $vo['wxname']; ?></font></font></td>
				  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $vo['username']; ?></font></font></td>
				  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $vo['phone']; ?></font></font></td>
				  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $vo['name']; ?></font></font></td>
				  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php if($vo['type'] == '1'): ?><span style="color:red">平台管理员</span><?php else: ?><span style="color:green">客户</span><?php endif; ?></font></font></td>
				  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
						<?php switch($vo['static']): case "0": ?><span style="color:red">拒绝</span><?php break; case "1": ?><span style="color:green">通过</span><?php break; case "2": ?><span style="color:blue">审核中</span><?php break; case "3": ?><span style="color:#333">未审核</span><?php break; endswitch; ?>
				  </font></font></td>
                  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $vo['create_time']; ?></font></font></td>
				  <td style="text-align:center;">
					<a href="<?php echo url('User/edit',['id'=>$vo['id']]); ?>"><button class="btn btn-primary btn-mini"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">修改</font></font></button></a>
					&nbsp;&nbsp;
					<a href="<?php echo url('User/del',['id'=>$vo['id']]); ?>"><button class="btn btn-danger btn-mini"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">删除</font></font></button></a>
				  </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </tbody>
            </table>
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
