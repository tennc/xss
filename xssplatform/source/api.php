<?php
/**
 * api.php 接口
 * ----------------------------------------------------------------
 * OldCMS,site:http://www.oldcms.com
 */
if(!defined('IN_OLDCMS')) die('Access Denied');

$id=Val('id','GET');
if($id){
	$db=DBConnect();
	$project=$db->FirstRow("SELECT * FROM ".Tb('project')." WHERE urlKey='{$id}'");
	if(empty($project)) exit();
	//用户提供的content
	$content=array();
	//待接收的key
	$keys=array();
	/* 模块 begin */
	$moduleIds=array();
	if(!empty($project['modules'])) $moduleIds=json_decode($project['modules']);
	if(!empty($moduleIds)){
		$modulesStr=implode(',',$moduleIds);
		$modules=$db->Dataset("SELECT * FROM ".Tb('module')." WHERE id IN ($modulesStr)");
		if(!empty($modules)){
			foreach($modules as $module){
				if(!empty($module['keys'])) $keys=array_merge($keys,json_decode($module['keys']));
			}	
		}
	}
	/* 模块 end */
	foreach($keys as $key){
		$content[$key]=Val($key,'REQUEST');	
	}
	if(in_array('toplocation',$keys)){
		$content['toplocation']=!empty($content['toplocation']) ? $content['toplocation'] : $content['location'];
	}

	$judgeCookie=in_array('cookie',$keys) ? true : false;
	/* cookie hash */
	$cookieHash=md5($project['id'].'_'.$content['cookie'].'_'.$content['location'].'_'.$content['toplocation']);
	$cookieExisted=$db->FirstValue("SELECT COUNT(*) FROM ".Tb('project_content')." WHERE projectId='{$project[id]}' AND cookieHash='{$cookieHash}'");
	if(!$judgeCookie || $cookieExisted<=0){
		//服务器获取的content
		$serverContent=array();
		$serverContent['HTTP_REFERER']=$_SERVER['HTTP_REFERER'];
		$referers=@parse_url($serverContent['HTTP_REFERER']);
		$domain=$referers['host']?$referers['host']: '';
		$domain=StripStr($domain);
		$serverContent['HTTP_REFERER']=StripStr($_SERVER['HTTP_REFERER']);
		$serverContent['HTTP_USER_AGENT']=StripStr($_SERVER['HTTP_USER_AGENT']);
		$serverContent['REMOTE_ADDR']=StripStr($_SERVER['HTTP_X_FORWARDED_FOR']);
		$values=array(
			'projectId'=>$project['id'],
			'content'=>JsonEncode($content),
			'serverContent'=>JsonEncode($serverContent),
			'domain'=>$domain,
			'cookieHash'=>$cookieHash,
			'num'=>1,
			'addTime'=>time()
		);
		$db->AutoExecute(Tb('project_content'),$values);
	}else{
		$db->Execute("UPDATE ".Tb('project_content')." SET num=num+1,updateTime='".time()."' WHERE projectId='{$project[id]}' AND cookieHash='{$cookieHash}'");
	}

	header("Location: $_SERVER[HTTP_REFERER] ");
}
?>