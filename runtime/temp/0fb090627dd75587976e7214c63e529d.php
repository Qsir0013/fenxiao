<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"E:\phpStudy\PHPTutorial\WWW\fen\public/../application/admin\view\agent\index.html";i:1531979420;s:73:"E:\phpStudy\PHPTutorial\WWW\fen\application\admin\view\public\header.html";i:1531972378;s:73:"E:\phpStudy\PHPTutorial\WWW\fen\application\admin\view\public\footer.html";i:1531973377;}*/ ?>
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
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">代理</font></font></h5>
			<a href=""><span class="label label-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">添加</font></font></span></a>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">渲染引擎</font></font></th>
                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">浏览器</font></font></th>
                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">平台（S）</font></font></th>
                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">引擎版本</font></font></th>
                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CSS等级</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">操作</font></font></th>

                </tr>
              </thead>
              <tbody>
                <tr class="odd gradeX">
                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">三叉戟</font></font></td>
                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Internet Explorer 4.0</font></font></td>
                  <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">赢得95+</font></font></td>
                  <td class="center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 4</font></font></td>
                  <td class="center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"></font></font></td>
				  <td class="center"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
					<button class="btn btn-danger btn-mini"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">删除</font></font></button>&nbsp;&nbsp;
					<button class="btn btn-primary btn-mini"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">修改</font></font></button>
					</font></font>
				  </td>
                </tr>
              </tbody>
            </table>
          </div>
		  
        </div>
      </div>
	  </div>
	  </div>
  </div>
</div>

<!--end-main-container-part-->

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
