<?php /* Smarty version 2.6.26, created on 2014-07-04 18:17:03
         compiled from project_create.html */ ?>
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
<script type="text/javascript">
function SubmitContent(){
	if($("#title").val()==""){
		ShowError("项目名称不能为空");
		return false;
	}
	$("#contentForm").submit();
}
function ShowError(content){
	$("#contentShow").attr("class","alert alert-danger");
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menus.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="col-sm-9">
          <div class="panel panel-default">
    	<div class="panel-heading">创建项目</div>
<form style="padding: 10px 15px;" id="contentForm" action="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=project&act=create_submit" method="post">
<input type="hidden" name="token" value="<?php echo $this->_tpl_vars['show']['user']['token']; ?>
" />
<fieldset> 
	<div id="contentShow"></div>
	<p> 
		<label for="title">项目名称</label><br> 
		<input type="text" class="title" name="title" id="title"> 
	</p> 
	
	<p> 
		<label for="description">项目描述</label><br> 
		<textarea name="description" id="description"></textarea>
	</p>
	<p> 
		<input class="btn btn-success" type="button" value="下一步" onclick="SubmitContent()"> &nbsp;&nbsp;
		<input class="btn btn-success" type="button" value="取消" onclick="history.go(-1)"> 
	</p> 
</fieldset> 
</form>
</div>
</div>
</div>
</body>
<script>document.getElementById('title').focus();</script>
</html>