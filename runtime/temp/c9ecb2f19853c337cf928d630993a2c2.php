<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"E:\phpStudy\PHPTutorial\WWW\fen\public/../application/admin\view\login\index.html";i:1531973281;}*/ ?>
<!DOCTYPE html>
<html>
<head>
		<base href="/static/admin/"/>
        <title>贝肯伟_登录</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="" method="post">
				 <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"></i></span><input name="username" type="text" placeholder="用户名" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input name="passwd" type="password" placeholder="密码" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-right"><a id="go" type="submit" class="btn btn-success" /> 登录</a></span>
                </div>
            </form>
        </div>
        <script src="js/jquery.min.js"></script>  
        
		<script>
			$(function(){
				$('#go').click(function(){
					$('#loginform').submit();
				})
				var event = arguments.callee.caller.arguments[0] || window.event;// 消除浏览器差异
				//第1种，任意触发
				$(document).keydown(function(event) {
					if (event.keyCode == 13) {
						$('#loginform').submit();		//登录事件
					}
				});
			})
		</script>
    </body>
</html>