<?php /* Smarty version 2.6.26, created on 2014-07-04 18:16:34
         compiled from user_invite.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'user_invite.html', 22, false),)), $this); ?>
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
</head>
<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="container">
<div class="col-sm-12">
          <div class="panel panel-default">
    	<div class="panel-heading">邀请码生成</div>
		<div style="padding: 10px 15px;">
	<h3>未使用的邀请码</h3>
	<table class="table" border="0" cellspacing="0" cellpadding="0">
		<b>乌云币奖品邀请码 (<?php echo count($this->_tpl_vars['codesWooyun']); ?>
)</b> 
		<a style="float: right;" href="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=user&act=createinvite&isWooyun=1">生成奖品邀请码</a>
		<thead>
			<tr>
				<th>邀请码 (生成时间倒序排列)</th>
			</tr>
		</thead>
		<tbody>
			<?php $_from = $this->_tpl_vars['codesWooyun']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
			<tr>
				<td><?php echo $this->_tpl_vars['v']['code']; ?>
</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>

	<table class="table" border="0" cellspacing="0" cellpadding="0">
		<b>其它邀请码 (<?php echo count($this->_tpl_vars['codesOther']); ?>
)</b> <a style="float: right;" href="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=user&act=createinvite&isWooyun=0">生成其它邀请码</a>
		<thead>
			<tr>
				<th>邀请码 (生成时间倒序排列)</th>
			</tr>
		</thead>
		<tbody>
			<?php $_from = $this->_tpl_vars['codesOther']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
			<tr>
				<td><?php echo $this->_tpl_vars['v']['code']; ?>
</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
</div>
</div>
</div>
</div>
</body>
</html>