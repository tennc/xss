<?php /* Smarty version 2.6.26, created on 2014-07-04 18:16:49
         compiled from module_set.html */ ?>
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
		ShowError("模块名称不能为空");
		return false;
	}
	$("#contentForm").submit();
}
function ShowError(content){
	$("#contentShow").attr("class","alert alert-danger");
	$("#contentShow").html(content);
}
function AddKey(obj,keyname){
	var liObj=document.createElement("li");
	$(obj).parent().before(liObj);
	var input=document.createElement("input");
	$(liObj).append(input);
	var btn=document.createElement("input");
	$(liObj).append(btn);
	$(liObj).append(document.createTextNode(" "));
	btn.type="button";
	$(btn).val("添加");
	$(liObj).append(document.createTextNode(" "));
	var del=document.createElement("a");
	$(liObj).append(del);
	$(del).attr("href","javascript:void(0)");
	$(del).html("删除");
	$(btn).click(function(){
		var txt=$(input).val();
		if(txt==""){
			alert("请输入参数名");
		}else{
			$(input).remove();
			$(btn).remove();
			var checkObj=document.createElement("input");
			$(del).before(checkObj);
			checkObj.type="checkbox";
			checkObj.checked="checked";
			var keyName=keyname!=null ? keyname : "keys[]";
			$(checkObj).attr("name",keyName);
			$(checkObj).attr("value",txt);
			$(del).before(document.createTextNode(" "+txt+" "));
		}
	});
	$(del).click(function(){
		$(liObj).remove();
	});
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
    	<div class="panel-heading">配置模块</div>
<form style="padding: 10px 15px;" id="contentForm" action="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=module&act=set_submit" method="post">
<input type="hidden" name="token" value="<?php echo $this->_tpl_vars['show']['user']['token']; ?>
" />
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['module']['id']; ?>
" />
<fieldset> 
	<div id="contentShow"></div>
	<p> 
		<label for="title">模块名称</label><br> 
		<input type="text" class="title" name="title" id="title" value="<?php echo $this->_tpl_vars['module']['title']; ?>
" /> 
	</p>
	<p> 
		<label for="description">模块描述</label><br> 
		<textarea style="height:80px" name="description" id="description"><?php echo $this->_tpl_vars['module']['description']; ?>
</textarea>
	</p>
    <p> 
		<label for="description">参数 (需要服务器接收的参数名)</label><br> 
        <ul id="keyList">
        	<?php $_from = $this->_tpl_vars['keys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
        	<li> <input name="keys[]" value="<?php echo $this->_tpl_vars['v']; ?>
" type="checkbox" checked="checked" /> <?php echo $this->_tpl_vars['v']; ?>
</li>
            <?php endforeach; endif; unset($_from); ?>
            <li><a href="javascript:void(0)" onclick="AddKey(this)">添加</a></li>
        </ul>
	</p>
	<p> 
		<label for="description">配置参数 (使用此模块时需要配置的参数，如参数名为user，则代码引用：<?php echo '{set.user}'; ?>
)</label><br> 
        <ul id="setkeyList">
        	<?php $_from = $this->_tpl_vars['setkeys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
        	<li> <input name="setkeys[]" value="<?php echo $this->_tpl_vars['v']; ?>
" type="checkbox" checked="checked" /> <?php echo $this->_tpl_vars['v']; ?>
</li>
            <?php endforeach; endif; unset($_from); ?>
            <li><a href="javascript:void(0)" onclick="AddKey(this,'setkeys[]')">添加</a></li>
        </ul>
	</p>
    <p> 
		<label for="description">代码</label> (<?php echo '{projectId}为项目id,{set.***}为***配置参数'; ?>
)<br> 
		<textarea name="code" id="code" style="width:700px"><?php echo $this->_tpl_vars['module']['code']; ?>
</textarea>
	</p>
    <p> 
		<label for="description">是否公开</label>  
        <input type="radio" name="isOpen" value="0"<?php if ($this->_tpl_vars['module']['isOpen'] == 0): ?> checked="checked"<?php endif; ?> /> 私有 
        <input type="radio" name="isOpen" value="1"<?php if ($this->_tpl_vars['module']['isOpen'] == 1): ?> checked="checked"<?php endif; ?> /> 公开 
        <br> 
	</p>
	<p> 
		<input class="btn btn-success" type="button" value="配置" onclick="SubmitContent()"> &nbsp;&nbsp;
		<input class="btn btn-success" type="button" value="取消" onclick="history.go(-1)"> 
	</p> 
</fieldset> 
</form>
</div>
</div>
</div>
</body>
</html>