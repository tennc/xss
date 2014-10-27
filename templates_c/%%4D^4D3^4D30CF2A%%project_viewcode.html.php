<?php /* Smarty version 2.6.26, created on 2014-07-04 18:17:12
         compiled from project_viewcode.html */ ?>
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
<style>
ul { margin:0}
</style>
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
    	<div class="panel-heading">项目代码</div>
		<div style="padding: 10px 15px;">
<caption><h3>项目名称: <?php echo $this->_tpl_vars['project']['title']; ?>
</h3></caption>
<p>
<label>项目代码：</label>
<pre>
<?php echo $this->_tpl_vars['code']; ?>

</pre>
</p>
<label>如何使用：</label>
<p>将如下代码植入怀疑出现xss的地方（注意'的转义），即可在 <a href="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=project&act=view&id=<?php echo $this->_tpl_vars['project']['id']; ?>
">项目内容</a> 观看XSS效果。</p>
<pre>
<?php echo $this->_tpl_vars['scriptShow1']; ?>

</pre>
</p>
<p>
或者
</p>
<p>
<pre>
<?php echo $this->_tpl_vars['scriptShow2']; ?>

</pre>
</p>

<p>

再或者以你任何想要的方式插入

</p>

<p>
<pre>
<?php echo $this->_tpl_vars['codeurl']; ?>

</pre>
</p>
<p> 
*************************************************网址缩短************************************************* 
</p> 
<p> 

再或者以你任何想要的方式插入 

</p> 

<p> 
<pre>
<?php echo $this->_tpl_vars['shortShow1']; ?>

</pre>
</p>
<p> 

再或者以你任何想要的方式插入 

</p> 

<p> 
<pre>
<?php echo $this->_tpl_vars['shortShow2']; ?>

</pre>
</p>

<p> 

再或者以你任何想要的方式插入 

</p> 

<p> 
<pre>
<?php echo $this->_tpl_vars['shortShow3']; ?>

</pre>
</p>

<p>
<?php if ($this->_tpl_vars['ty'] == 'create'): ?>
<input class="btn btn-success" type="button" value="完成" onclick="location.href='<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php'" />
<?php else: ?>
<input class="btn btn-success" type="button" value="返回首页" onclick="location.href='<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php'" />
<?php endif; ?>
</p>
</div>
</div>
</div>
</div>
</body>
</html>