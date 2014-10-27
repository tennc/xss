<?php
/**
 * function.php 方法库
 * ----------------------------------------------------------------
 * OldCMS,site:http://www.oldcms.com
 */
if(!defined('IN_OLDCMS')) die('Access Denied');

/**
	DBConnect 数据库连接方法
	@param 	$configFile		string	数据库配置文件
	@return $db				object	BlueDB类对象
 */
function DBConnect($configFile=''){
	if(!file_exists($configFile)) $configFile=ROOT_PATH.'/config.php';
	require($configFile);
	require_once(ROOT_PATH.'/source/class/DB.class.php');
	$db=BlueDB::DB($config['dbType']);
	$db->Connect($config['dbHost'],$config['dbUser'],$config['dbPwd'],$config['database'],$config['charset'],$config['tbPrefix']);
	return $db;
}

/* 获得Smarty对象 */
function InitSmarty($isAdmin=0){
	require_once(ROOT_PATH.'/libs/Smarty.class.php');
	$smarty=new Smarty;
	$smarty->template_dir=($isAdmin==0 ? TEMPLATE_PATH : ADMIN_PATH).'/templates';
	return $smarty;
}

/**
	OCEncrypt oldcms加密
	@param 	$str	string	待加密的字符
	@return $str	string	密码串
*/
function OCEncrypt($str){
	return md5('OldCMS|'.$str);
}

/* OCSetCookie setcookie封装 */
function OCSetCookie($name='',$value='',$expires=0,$path='/',$domain='',$httponly=true){
	$path=$httponly && PHP_VERSION < '5.2.0' ? "$path; HttpOnly" : $path;
	$secure=$_SERVER['SERVER_PORT']==443 ? 1 : 0;
	if(PHP_VERSION<'5.2.0'){
		setcookie($name,$value,$expires,$path,$domain,$secure);
	}else{
		setcookie($name,$value,$expires,$path,$domain,$secure,$httponly);
	}
}

/* 获得IP */
function IP(){
	return $_SERVER['REMOTE_ADDR'];
}

/* StripStr 过滤字符 */
function StripStr($str){
	if(get_magic_quotes_gpc()) $str=stripslashes($str);
	return addslashes(htmlspecialchars($str,ENT_QUOTES));
}

/* 获得http referer */
function HTTP_REFERER(){
	return htmlspecialchars($_SERVER['HTTP_REFERER']);
}

/**
	Val 获得提交的值
	@param 	$name		string			参数名
	@param 	$method		string			获取途径(GET/POST/COOKIE/REQUEST)
	@param 	$type		string/int		过滤类型('string'/0=>string,'int'/1=>int,其它/2=>不过滤)
	@param 	$isArray	int				0=>非数组,1=>数组
	@return $value		string/int	
*/
function Val($name,$method='GET',$type=0,$isArray=0){
	if($name=='' || !is_string($name)) return '';
	$method=strtoupper($method);
	switch($method){
		case 'GET':
			$value=$_GET[$name];
			break;
		case 'POST':
			$value=$_POST[$name];
			break;
		case 'COOKIE':
			$value=$_COOKIE[$name];
			break;
		case 'REQUEST':
			$value=$_REQUEST[$name];
			break;
		case 'SERVER':
			$value=$_SERVER[$name];
			break;
		default:break;
	}
	$isArray=intval($isArray);
	switch($type){
		case 0:
		case 'string':
			$value=($isArray==0) ? StripStr($value) : array_map('StripStr',(array)$value);
			break;
		case 1:
		case 'int':
			$value=($isArray==0) ? intval($value) : array_map('intval',(array)$value);
			break;
		case 2:
		default:break;
	}
	return $value;
}
/* json_enocde */
function JsonEncode($value){
	return json_encode($value);
}

/* 正确提示 */
function ShowSuccess($str='',$turnto=URL_ROOT,$urltitle='返回'){
	Notice($str,$turnto,3,'success',$urltitle);
}

/* 错误提示 */
function ShowError($str='',$turnto=URL_ROOT,$urltitle='返回'){
	Notice($str,$turnto,3,'error',$urltitle);
}

/* 统一提示方法 */
function Notice($str='',$turnto=URL_ROOT,$time=3,$style='success',$urltitle){
	global $show,$url;
	$notice=array(
		'str'=>$str,
		'turnto'=>$turnto,
		'time'=>$time,
		'style'=>$style,
		'urltitle'=>$urltitle
	);
	$smarty=InitSmarty();
	$smarty->assign('show',$show);
	$smarty->assign('url',$url);
	$smarty->assign('notice',$notice);
	$smarty->display('notice.html');
	exit;
}

/* UBB To HTML */
function UBBToHTML($str=''){
	if(!empty($str)){
		$str=preg_replace("/\[(b|i|u)\](.*?)\[\/\\1\]/is","<$1>$2</$1>",$str);
		$str=preg_replace("/\[code\](.*?)\[\/code]/ise","DoCode('$1')",$str);
		$str=str_replace("\n",'<br />',$str);
		$str=preg_replace("/\[link\s+?href=(\'\"|&quot;)(.*?)\\1\](.*?)\[\/link\]/i","<a target=\"_blank\" href=\"$2\">$3</a>",$str); //链接
		$str=preg_replace("/\[img\s+?src=(\'\"|&quot;)([\w\:\/\.]*?\/\w+?\.(jpg|jpeg|gif|png))\s*?\\1(\s+alt=(\'\"|&quot;)(.*?)\\5\s*?)?\/]/i","<a target=\"_blank\" href=\"$2\" title=\"$6\"><img src=\"$2\" alt=\"$6\" /></a>",$str); //图片
		$str=preg_replace("/\[video\s+?href=(\'\"|&quot;)([\w\:\/\.]*?\/\w+?\.swf)\s*?\\1\/]/i","<embed src=\"$2\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"never\" allowfullscreen=\"true\" wmode=\"opaque\" width=\"480\" height=\"400\"></embed>",$str); //视频
		$str=str_replace('  ','&nbsp;&nbsp;',$str);
		$str=str_replace("\t",'&nbsp;&nbsp;',$str);
	}
	return $str;
}
function DoCode($str){
	$str=trim($str);
	return '<code>'.$str.'</code>';
}

/* 获得文件后缀 */
function FileSuffix($name){
	$lastPos=strrpos($name,'.');
	$suffix=$lastPos ? substr($name,$lastPos+1,strlen($name)-$lastPos) : '';
	return strtolower($suffix);
}

/* GetTimeShow $time的人性化显示 */
function GetTimeShow($time=0){
	$diff=time()-$time;
	$num=0;
	$unit='';
	if($diff<60){
		$num=$diff;
		$unit='秒';
	}elseif($diff<3600){
		$num=intval($diff/60);
		$unit='分钟';
	}elseif($diff<86400){
		$num=intval($diff/3600);
		$unit='小时';
	}elseif($diff<2592000){
		$num=intval($diff/86400);
		$unit='天';
	}elseif($diff<31104000){
		$num=intval($diff/2592000);
		$unit='月';
	}else{
		$num=intval($diff/31104000);
		$unit='年';
	}
	return $num.$unit.'前';
}

/* 发送邮件 */
function SendMail($to='',$subject='',$body=''){
	global $mailConfig;
	require_once(ROOT_PATH.'/source/class/PHPMailer.class.php');
	try{
		$mail = new PHPMailer();							// New instance, with exceptions enabled
		switch($mailConfig['mailer']){						// tell the class to use SMTP/Mail/Sendmail/Qmail
			case 'smtp':
				$mail->IsSMTP();
				$mail->SMTPAuth   = true;					// enable SMTP authentication
				$mail->Host       = $mailConfig['host'];	// SMTP server
				$mail->Port       = $mailConfig['port'];	// set the SMTP server port
				$mail->Username   = $mailConfig['username'];// SMTP server username
				$mail->Password   = $mailConfig['password'];// SMTP server password
				break;
			case 'mail':
				$mail->IsMail();
				break;
			case 'sendmail':
				$mail->IsSendMail();
				break;
			case 'qmail':
				$mail->IsQMail();
				break;
			default:
				return false;
				break;
		}
		$mail->CharSet    = $mailConfig['charset'];
		$mail->Encoding   = 'base64';
		$mail->SMTPDebug  = false;
		$mail->AddReplyTo($mailConfig['username'],$mailConfig['name']);
	
		$mail->From       = $mailConfig['username'];
		$mail->FromName   = $mailConfig['name'];
		$mail->AddAddress($to);
	
		$mail->Subject  = $subject;
		$mail->WordWrap   = 80;
		$mail->MsgHTML($body);
		$mail->IsHTML($mailConfig['contentType'] ? true : false);
		$mail->Send();
		return true;
	}catch(phpmailerException $e){
		return false;
	}
}

/* Tb 获取table name */
function Tb($name){
	return TABLE_PREFIX.$name;
}

/* 短网址字符 */
function ShortUrlCode($existed=array(),$num=6){
	$str='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$len=strlen($str);
	$code='';
	for($i=0;$i<$num;$i++){
		$k=rand(0,$len-1);
		$code.=$str[$k];
	}
	if(in_array($code,$existed)) $code=ShortUrlCode($existed,$num);
	return $code;
}
?>