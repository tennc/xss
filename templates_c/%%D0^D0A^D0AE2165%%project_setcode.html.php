<?php /* Smarty version 2.6.26, created on 2014-07-04 18:17:06
         compiled from project_setcode.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'project_setcode.html', 48, false),)), $this); ?>
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
<script type="text/javascript">
<?php echo '
function ShowContent(id,o){
	if($("#"+id).css("display")=="none"){
		$("#"+id).show();
		$(o).html("折叠");
	}else{
		$("#"+id).hide();
		$(o).html("展开");	
	}
}
'; ?>

</script>
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
    	<div class="panel-heading">配置代码</div>
<form style="padding: 10px 15px;" id="contentForm" action="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=project&act=setcode_submit" method="post">
<input type="hidden" name="token" value="<?php echo $this->_tpl_vars['show']['user']['token']; ?>
" />
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['project']['id']; ?>
" />
<input type="hidden" name="ty" value="<?php echo $this->_tpl_vars['ty']; ?>
" />
<fieldset> 
	<div id="contentShow"></div>
	<p> 
		<label for="title">项目名称</label><br> 
		<h2><?php echo $this->_tpl_vars['project']['title']; ?>
</h2> 
	</p> 
	<p> 
		<ul id="moduleList">
        	<?php $_from = $this->_tpl_vars['modulesCan']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        	<li style="margin-bottom:10px"> <input onclick="<?php echo 'if(this.checked){ $(\'#mset_\'+this.value).show() }else{ $(\'#mset_\'+this.value).hide() }'; ?>
" name="modules[]" value="<?php echo $this->_tpl_vars['v']['id']; ?>
" type="checkbox"<?php if ($this->_tpl_vars['v']['choosed'] == 1): ?> checked="checked"<?php endif; ?> /> <?php echo $this->_tpl_vars['v']['title']; ?>
 
            <a href="javascript:void(0)" onclick="ShowContent('m_<?php echo $this->_tpl_vars['k']; ?>
',this)">展开</a>
            <?php if (count($this->_tpl_vars['v']['setkeys']) > 0): ?>
            <div id="mset_<?php echo $this->_tpl_vars['v']['id']; ?>
" style="display:<?php if ($this->_tpl_vars['v']['choosed'] == 1): ?>block<?php else: ?>none<?php endif; ?>">
            需要配置的参数<br/>
            	<?php $_from = $this->_tpl_vars['v']['setkeys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['setkey']):
?>
            	<?php if ($this->_tpl_vars['v']['id'] == 1 && $this->_tpl_vars['setkey']['key'] == 'keepsession'): ?>
	            <input type="radio" name="setkey_<?php echo $this->_tpl_vars['v']['id']; ?>
_<?php echo $this->_tpl_vars['setkey']['key']; ?>
" value="0"<?php if ($this->_tpl_vars['setkey']['value'] != 1): ?> checked="checked"<?php endif; ?> /> 无keepsession &nbsp; 
	            <input type="radio" name="setkey_<?php echo $this->_tpl_vars['v']['id']; ?>
_<?php echo $this->_tpl_vars['setkey']['key']; ?>
" value="1"<?php if ($this->_tpl_vars['setkey']['value'] == 1): ?> checked="checked"<?php endif; ?> /> keepsession
	            <?php else: ?>
                <?php echo $this->_tpl_vars['setkey']['key']; ?>
 : <input type="text" name="setkey_<?php echo $this->_tpl_vars['v']['id']; ?>
_<?php echo $this->_tpl_vars['setkey']['key']; ?>
" value="<?php echo $this->_tpl_vars['setkey']['value']; ?>
" /><br/>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </div>
            <?php endif; ?>
            <ul id="m_<?php echo $this->_tpl_vars['k']; ?>
" style="display:none">
                <li style="list-style:none">参数:<br /><?php echo $this->_tpl_vars['v']['keys']; ?>
</li>
                <li style="list-style:none">代码:<br /><?php echo $this->_tpl_vars['v']['code']; ?>
</li>
            </ul>
            </li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
	</p>
	<p> 
		<label for="code"><input type="checkbox" checked="checked" disabled="disabled" /> 自定义代码</label><br> 
		<textarea name="code" id="code"></textarea>
	</p>
	<p> 
		<input class="btn btn-success" type="submit" value="<?php if ($this->_tpl_vars['ty'] == 'create'): ?>下一步<?php else: ?>配置<?php endif; ?>"> &nbsp;&nbsp;
		<input class="btn btn-success" type="button" value="取消" onclick="history.go(-1)"> 
	</p> 
</fieldset> 
</form>
</div>
</div>
</div>
</body>
</html>