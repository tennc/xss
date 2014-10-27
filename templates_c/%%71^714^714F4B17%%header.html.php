<?php /* Smarty version 2.6.26, created on 2014-07-04 18:16:02
         compiled from header.html */ ?>
﻿<div class="navbar navbar-fixed-top navbar-inverse">
   <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php">Xss平台</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php">主页</a></li>
			<!--
            <li><a href="#about">关于</a></li>
            <li><a href="#contact">博客</a></li>
			-->
          </ul>
		  <?php if ($this->_tpl_vars['show']['user']['userId'] < 1): ?>
		  	<ul class="nav navbar-nav navbar-right ng-scope" ng-controller="user_ctrl" id="header_me">
                <li>
                    <a class="mr_15" wt-tracker="Header|Menu|Goto Signin" href="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=login">登录</a>
                <iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe></li>
                <li>
                    <a href="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=register" wt-tracker="Header|Menu|Goto Apply">注册</a>
                </li>
                
            </ul>
			<?php endif; ?>
		  <?php if ($this->_tpl_vars['show']['user']['userId'] > 0): ?>
		  <ul class="nav navbar-nav navbar-right ng-scope" ng-controller="user_ctrl" id="header_me">
                <li>
                    <a href="#" wt-tracker="Header|Menu|Goto Apply">用户：<?php echo $this->_tpl_vars['show']['user']['userName']; ?>
</a>
                <iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe></li>
                <li>
                    <a href="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=user&act=seting" wt-tracker="Header|Menu|Goto Apply">个人设置</a>
                </li>
				<?php if ($this->_tpl_vars['show']['user']['adminLevel'] > 0): ?>
				  <li>
                    <a href="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=user&act=invite" wt-tracker="Header|Menu|Goto Apply">邀请</a>
                </li>
				<?php endif; ?>
                <li>
                    <a href="<?php echo $this->_tpl_vars['url']['root']; ?>
/index.php?do=login&act=logout" wt-tracker="Header|Menu|Goto Apply">退出登陆</a>
                </li>
            </ul>
			<?php endif; ?>
        </div><!--/.nav-collapse -->
      <iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe></div>
    </div>