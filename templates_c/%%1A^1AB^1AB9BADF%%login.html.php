<?php /* Smarty version 2.6.26, created on 2014-07-04 18:16:09
         compiled from login.html */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>XSS Platform</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['url']['themePath']; ?>
/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['url']['themePath']; ?>
/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['url']['themePath']; ?>
/css/css.css">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://www.bootstrapcdn.com/bootstrap/2.3.1/js/bootstrap.min.js"></script>
<?php echo '
<script>
function Login(){
	if($("#user").val()==""){
		ShowError("用户名不能为空");
		return false;
	}
	if($("#pwd").val()==""){
		ShowError("密码不能为空");
		return false;
	}
}
function ShowError(content){
	$("#contentShow").attr("class","error");
	$("#contentShow").html(content);
}
</script>
'; ?>

</head>
<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="container">
<form class="form-signin" action="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=login&act=submit" method="post" onsubmit="return Login()">
<div class="panel panel-default">
  <div class="panel-heading">登陆</div>
  <div class="panel-body">
<div class="form-group">
<div class="input-group">
<span class="input-group-addon">
<i class="glyphicon glyphicon-user"></i>
</span>
<input class="form-control ng-pristine ng-invalid ng-invalid-required valid" type="text" placeholder="输入用户名/邮箱" name="user" id="user">
<iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe></div>
</div>
<div class="form-group">
       <div class="input-group">
           <span class="input-group-addon fs_17"><i class="glyphicon glyphicon-lock"></i><iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe></span>
              <input class="form-control ng-pristine ng-invalid ng-invalid-required valid" type="password" placeholder="输入密码" name="pwd" id="pwd">
       </div>
</div>
<button class="btn btn-lg btn-primary btn-block" type="submit">登陆</button>
</div>
</div>
</form>
</div>

</html>