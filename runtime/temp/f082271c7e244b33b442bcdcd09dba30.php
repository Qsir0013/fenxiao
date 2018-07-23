<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"D:\php\PHPTutorial\WWW\llll\public/../application/admin\view\agent\index.html";i:1532056925;s:69:"D:\php\PHPTutorial\WWW\llll\application\admin\view\public\header.html";i:1532166178;}*/ ?>
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
	<div class="span12">
      <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">产品</font></font></h5>
            <a href="<?php echo url('Agent/add'); ?>"><span class="label label-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">添加</font></font></span> </div></a>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
				  <th style="width:40px"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">序号</font></font></th>
                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">代理角色</font></font></th>
                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">优惠力度（折扣按百分比显示）</font></font></th>
                  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">添加日期</font></font></th>
				  <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">操作</font></font></th>
                </tr>
              </thead>
              <tbody>
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
				  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $vo['id']; ?></font></font></td>
                  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $vo['name']; ?></font></font></td>
                  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $vo['discount']; ?></font></font></td>
                  <td style="text-align:center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $vo['create_time']; ?></font></font></td>
				  <td style="text-align:center;">
					<a href="<?php echo url('Agent/edit',['id'=>$vo['id']]); ?>"><button class="btn btn-primary btn-mini"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">修改</font></font></button></a>
					&nbsp;&nbsp;
					<a href="<?php echo url('Agent/del',['id'=>$vo['id']]); ?>"><button class="btn btn-danger btn-mini"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">删除</font></font></button></a>
				  </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
              </tbody>
            </table>
          </div>
			<?php if($list == ''): else: ?>
				<div  class="list-page"><?php echo $list->render(); ?><p>共<?php echo $list->total(); ?>条 <?php echo $list->currentPage(); ?>/<?php echo $list->lastPage(); ?> 页</p></div>
			<?php endif; ?>
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
