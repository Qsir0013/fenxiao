<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"E:\phpStudy\PHPTutorial\WWW\fen\public/../application/admin\view\login\cinfo.html";i:1531979491;s:73:"E:\phpStudy\PHPTutorial\WWW\fen\application\admin\view\public\header.html";i:1531972378;s:73:"E:\phpStudy\PHPTutorial\WWW\fen\application\admin\view\public\footer.html";i:1531973377;}*/ ?>
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
    <li  class="dropdown" id="profile-messages" ><a title="" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">欢迎您：<?php echo \think\Session::get('A')['username']; ?></span></a></li>
    <li class=""><a title="修改信息" href="<?php echo url('Login/cinfo'); ?>"><i class="icon icon-cog"></i> <span class="text">修改信息</span></a></li>
    <li class=""><a title="退出系统" href="<?php echo url('Login/singOut'); ?>"><i class="icon icon-share-alt"></i> <span class="text">退出</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i>菜单</a>
  <ul>
    <li class="submenu"> <a href="#"><i class="icon icon-leaf"></i> <span>产品管理</span></a>
      <ul>
        <li><a href="<?php echo url('Pro/index'); ?>">产品列表</a></li>
      </ul>
    </li>
	<li class="submenu"> <a href="#"><i class="icon icon-user"></i> <span>用户管理</span></a>
      <ul>
        <li><a href="<?php echo url('User/index'); ?>">用户列表</a></li>
      </ul>
    </li>
	<li class="submenu"> <a href="#"><i class="icon icon-arrow-down"></i> <span>代理管理</span></a>
      <ul>
        <li><a href="<?php echo url('Agent/index'); ?>">代理列表</a></li>
      </ul>
    </li>
  </ul>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a class="tip-bottom"><i class="icon-home"></i> </a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  
<!--End-Action boxes-->    

<!--Chart-box-->
	<div id="content">
	  <div class="container-fluid">
	  <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">个人信息</font></font></h5>
        </div>
        <div class="widget-content nopadding">
          <form action="" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户名：</font></font></label>
              <div class="controls">
                <input type="text" name="username" class="span11" placeholder="First name">
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">新密码：</font></font></label>
              <div class="controls">
                <input type="password" name="passwd" class="span11" placeholder="Enter Password">
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
  </div>
</div>

<!--end-main-container-part-->
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
<script src="js/jquery.validate.js"></script> 
<script src="js/matrix.form_validation.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/matrix.popover.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
</body>
</html>
