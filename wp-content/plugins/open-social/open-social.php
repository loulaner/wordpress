<?php
/**
 * Plugin Name: Open Social for China
 * Plugin URI: http://www.xiaomac.com/201311150.html
 * Description: Allow to Login or Share with social networks (specially in china) like QQ, Sina WeiBo, Baidu, Google, Live, DouBan, RenRen, KaiXin. NO 3rd-party!
 * Author: Afly
 * Author URI: http://www.xiaomac.com/
 * Version: 1.1.4
 * License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: open-social
 * Domain Path: /lang
 */

if(file_exists(dirname(__FILE__).'/setting.php')) include_once( 'setting.php' );
if (!session_id()) session_start();

//init
add_action('init', 'open_init', 1);
function open_init() {
	load_plugin_textdomain( 'open-social', '', dirname( plugin_basename( __FILE__ ) ) . '/lang' );
	$GLOBALS['open_str'] = array(
		'qq'		=> __('QQ','open-social'),
		'sina'		=> __('Sina','open-social'),
		'baidu'		=> __('Baidu','open-social'),
		'google'	=> __('Google','open-social'),
		'live'		=> __('Microsoft Live','open-social'),
		'douban'	=> __('Douban','open-social'),
		'renren'	=> __('RenRen','open-social'),
		'kaixin'	=> __('Kaixin001','open-social'),
		'login' 	=> __('Login with %OPEN_TYPE%','open-social'),
		'unbind'	=> __('Unbind with %OPEN_TYPE%','open-social'),
		'share'		=> __('Share with %SHARE_TYPE%','open-social'),
		'share_weibo'	=> __('Sina','open-social'),
		'share_qzone'	=> __('QQZone','open-social'),
		'share_qqt'		=> __('QQWeiBo','open-social'),
		'share_youdao'	=> __('YoudaoNote','open-social'),
		'share_email'	=> __('Email to Me','open-social'),
		'share_qq'		=> __('Chat with Me','open-social'),
		'share_weixin'	=> __('WeiXin','open-social'),
		'share_google'	=> __('Google Translation','open-social'),
		'share_twitter'	=> __('Twitter','open-social'),
		'share_facebook'	=> __('Facebook','open-social'),
		'setting_button'	=> __('Settings','open-social'),
		'setting_menu'		=> __('Open Social Setting','open-social'),
		'language_switch'	=> __('Language Switcher','open-social'),
		'callback'			=> __('CALLBACK','open-social'),
		'widget_title'		=> __('Open Social Login', 'open-social'),
		'widget_name'		=> __('Howdy', 'open-social'),
		'widget_desc'		=> __('Display your Open Social login button', 'open-social'),
		'widget_share_title'	=> __('Open Social Share', 'open-social'),
		'widget_share_name'		=> __('Connect', 'open-social'),
		'widget_share_desc'		=> __('Display your Open Social share button', 'open-social'),
		'err_other_openid'		=> __('This account has been bound by other user.','open-social'),
		'err_other_user'		=> __('You can only bind to one account at a time.','open-social'),
		'err_other_email'		=> __('Your EMAIL has been registered by other user.','open-social'),
		'setting_menu_adv'		=> __('Account Setting','open-social'),
		'about_title'			=> __('About this plugin','open-social'),
		'about_info'			=> __('if you like this plugin','open-social'),
		'about_alipay'			=> __('Buy me a drink','open-social'),
		'about_link'			=> __('Or leave me a link.','open-social'),
		'about_plugin'			=> __('Or give me Five','open-social'),
		'osop_login_button'			=> __('Login Buttons','open-social'),
		'osop_show_login_form1'		=> __('Before Comment Form','open-social'),
		'osop_show_login_form2'		=> __('After Comment Form','open-social'),
		'osop_show_login_form0'		=> __('None','open-social'),
		'osop_show_login_page'		=> __('Login Page','open-social'),
		'osop_share_button'			=> __('Share Button','open-social'),
		'osop_show_share_content'	=> __('After Blog Content','open-social'),
		'osop_share_sina_user'		=> __('Sina Weibo related UserID','open-social'),
		'osop_share_qqt_appkey'		=> __('QQ Weibo Share AppKey','open-social'),
		'osop_share_qq_email'		=> __('QQ EmailMe Code','open-social'),
		'osop_share_qq_talk'		=> __('QQ ContactMe Link','open-social'),
		'osop_delete_setting'		=> __('Auto delete Configuration Above after Uninstallation. NOT RECOMMENDED!','open-social'),
		'edit_fake_email'			=> __('UnFake Your Email','open-social'),
		'xiaomi'					=> __('XiaoMi','open-social'),
		'open_social_hide_text'		=> __('Login to Display','open-social'),
	);
	if (isset($_GET['connect'])) {
		define('OPEN_TYPE',$_GET['connect']);
		if(OPEN_TYPE=='qq'){
			$os = new QQ_CLASS();
		}elseif(OPEN_TYPE=='sina'){
			$os = new SINA_CLASS();
		}elseif(OPEN_TYPE=='baidu'){
			$os = new BAIDU_CLASS();
		}elseif(OPEN_TYPE=='google'){
			$os = new GOOGLE_CLASS();
		}elseif(OPEN_TYPE=='live'){
			$os = new LIVE_CLASS();
		}elseif(OPEN_TYPE=='douban'){
			$os = new DOUBAN_CLASS();
		}elseif(OPEN_TYPE=='renren'){
			$os = new RENREN_CLASS();
		}elseif(OPEN_TYPE=='kaixin'){
			$os = new KAIXIN_CLASS();
		}elseif(OPEN_TYPE=='xiaomi'){
			$os = new XIAOMI_CLASS();
		}else{
			exit();
		}
		if ($_GET['action'] == 'login') {
			if($_GET['back']) $_SESSION['back'] = $_GET['back'];
			$os -> open_login();
		} else if ($_GET['action'] == 'callback') {
			if(!isset($_GET['code'])){
				echo '<script>opener.window.focus();window.close();</script>';
				exit();
			}
			$os -> open_callback($_GET['code']);
			open_action( $os );
		} else if ($_GET['action'] == 'unbind') {
			open_unbind();
		} else if ($_GET['action'] == 'update'){
			if (OPEN_TYPE=='sina' && isset($_GET['text'])) open_update_test($_GET['text']);
		}
	}else{
		if (isset($_GET['code']) && isset($_GET['state'])) {
			if($_GET['state']=='profile') header('Location:'.GG_BACK.'?connect=google&action=callback&'.http_build_query($_GET));//for google
			if(strlen($_GET['state'])==32) header('Location:'.DB_BACK.'?connect=douban&action=callback&'.http_build_query($_GET));//for douban
			exit();
		}
	} 
} 

//lang
add_filter( 'locale', 'open_social_locale' );
function open_social_locale( $lang ) {
	if ( isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) && !isset($_SESSION['WPLANG_LOCALE']) ) {
		$languages = strtolower( $_SERVER["HTTP_ACCEPT_LANGUAGE"] );
		$languages = explode( ",", $languages );
		$languages = explode( "-", $languages[0] );
		$_SESSION['WPLANG_LOCALE'] = strtolower($languages[0]) . '_' . strtoupper($languages[1]);
	}
	if ( isset( $_GET['open_lang'] ) && strpos($_GET['open_lang'], "_") ) {
		$_SESSION['WPLANG'] = $_GET['open_lang'];
		header('Location:'.$_SERVER['PHP_SELF']);
		exit();
	} else {
		if( isset($_SESSION['WPLANG']) && strpos($_SESSION['WPLANG'], "_") ) {
			return $_SESSION['WPLANG'];
		} else {
			$_SESSION['WPLANG'] = $lang;
			return $lang;
		}
	} 
}

class QQ_CLASS {
	function open_login() {
		$_SESSION['state'] = md5(uniqid(rand(), true));
		$params=array(
			'response_type'=>'code',
			'client_id'=>QQ_AKEY,
			'state'=>$_SESSION['state'],
			'scope'=>'get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo',
			'redirect_uri'=>QQ_BACK.'?connect=qq&action=callback'
		);
		header('Location:https://graph.qq.com/oauth2.0/authorize?'.http_build_query($params));
		exit();
	} 
	function open_callback($code) {
		$params=array(
			'grant_type'=>'authorization_code',
			'code'=>$code,
			'client_id'=>QQ_AKEY,
			'client_secret'=>QQ_SKEY,
			'redirect_uri'=>QQ_BACK.'?connect=qq&action=callback'
		);
		$str = file_get_contents('https://graph.qq.com/oauth2.0/token?'.http_build_query($params));
        $token = array();
        parse_str($str, $token);
		$_SESSION['access_token'] = $token['access_token'];
		$str = file_get_contents("https://graph.qq.com/oauth2.0/me?access_token=".$_SESSION['access_token']);
		if (strpos($str, "callback") !== false) {
			$lpos = strpos($str, "(");
			$rpos = strrpos($str, ")");
			$str = substr($str, $lpos + 1, $rpos - $lpos -1);
		} 
		$ret = json_decode($str);
		if (isset($ret -> error)) open_close("<h3>error:</h3>" . $ret -> error . "<h3>msg  :</h3>" . $ret -> error_description);
		$_SESSION['open_id'] = $ret -> openid;
	} 
	function open_new_user(){
		$str = open_connect_http('https://graph.qq.com/user/get_user_info?access_token='.$_SESSION['access_token'].'&oauth_consumer_key='.QQ_AKEY.'&openid='.$_SESSION['open_id']);
		$nickname = $str['nickname'];
		$str = open_connect_http('https://graph.qq.com/user/get_info?access_token='.$_SESSION['access_token'].'&oauth_consumer_key='.QQ_AKEY.'&openid='.$_SESSION['open_id']);
		$name = $str['data']['name'];//t.qq.com/***
		return array(
			'nickname' => $nickname?$nickname:'QQ'.time(),
			'display_name' => $nickname?$nickname:'QQ'.time(),
			'user_url' => $name?'http://t.qq.com/'.$name:'',
			'user_email' => ($name?$name:strtolower($_SESSION['open_id'])).'@t.qq.com'//fake
		);
	}
} 

class SINA_CLASS {
	function open_login() {
		$params=array(
			'response_type'=>'code',
			'client_id'=>WB_AKEY,
			'redirect_uri'=>WB_BACK.'?connect=sina&action=callback'
		);
		header('Location:https://api.weibo.com/oauth2/authorize?'.http_build_query($params));
		exit();
	} 
	function open_callback($code) {
		$params=array(
			'grant_type'=>'authorization_code',
			'code'=>$code,
			'client_id'=>WB_AKEY,
			'client_secret'=>WB_SKEY,
			'redirect_uri'=>WB_BACK.'?connect=sina&action=callback'
		);
		$str = open_connect_http('https://api.weibo.com/oauth2/access_token', http_build_query($params), 'POST');
		$_SESSION["access_token"] = $str["access_token"];
		$_SESSION['open_id'] = $str["uid"];
	}
	function open_new_user(){
		$user = open_connect_http("https://api.weibo.com/2/users/show.json?access_token=".$_SESSION["access_token"]."&uid=".$_SESSION['open_id']);
		return array(
			'nickname' => $user['screen_name'],
			'display_name' => $user['screen_name'],
			'user_url' => 'http://weibo.com/'.$user['profile_url'],
			'user_email' => $_SESSION['open_id'].'@weibo.com'//fake
		);
	} 
} 

class BAIDU_CLASS {
	function open_login() {
		$params=array(
			'response_type'=>'code',
			'client_id'=>BD_AKEY,
			'redirect_uri'=>BD_BACK.'?connect=baidu&action=callback',
			'scope'=>'basic',
			'display'=>'page'
		);
		header('Location:https://openapi.baidu.com/oauth/2.0/authorize?'.http_build_query($params));
		exit();
	} 
	function open_callback($code) {
		$params=array(
			'grant_type'=>'authorization_code',
			'code'=>$code,
			'client_id'=>BD_AKEY,
			'client_secret'=>BD_SKEY,
			'redirect_uri'=>BD_BACK.'?connect=baidu&action=callback'
		);
		$str = open_connect_http('https://openapi.baidu.com/oauth/2.0/token', http_build_query($params), 'POST');
		$_SESSION["access_token"] = $str["access_token"];
	}
	function open_new_user(){
		$user = open_connect_http("https://openapi.baidu.com/rest/2.0/passport/users/getLoggedInUser?access_token=".$_SESSION["access_token"]);
		$_SESSION['open_id'] = $user['portrait'];//for avatar
		return array(
			'nickname' => $user["uname"],
			'display_name' => $user["uname"],
			'user_url' => 'http://www.baidu.com/p/'.$user['uname'],
			'user_email' => $user["uid"].'@baidu.com'//fake
		);
	}
} 

class GOOGLE_CLASS {
	function open_login() {
		$params=array(
			'response_type'=>'code',
			'client_id'=>GG_AKEY,
			'scope'=>'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
			'redirect_uri'=> GG_BACK,
			'state'=>'profile',
			'access_type'=>'offline'
		);
		header('Location:https://accounts.google.com/o/oauth2/auth?'.http_build_query($params));
		exit();
	} 
	function open_callback($code) {
		$params=array(
			'grant_type'=>'authorization_code',
			'code'=>$code,
			'client_id'=>GG_AKEY,
			'client_secret'=>GG_SKEY,
			'redirect_uri'=>GG_BACK
		);
		$str = open_connect_http('https://accounts.google.com/o/oauth2/token', http_build_query($params), 'POST');
		$_SESSION["access_token"] = $str["access_token"];
	}
	function open_new_user(){
		$user = open_connect_http("https://www.googleapis.com/oauth2/v1/userinfo?access_token=".$_SESSION["access_token"]);
		$_SESSION['open_id'] = $user["id"];
		return array(
			'nickname' => $user['name'],
			'display_name' => $user['name'],
			'user_url' => 'http://plus.google.com/'.$_SESSION['open_id'],
			'user_email' => $user["email"]//this one is real
		);
	}
} 

class LIVE_CLASS {
	function open_login() {
		$params=array(
			'response_type'=>'code',
			'client_id'=>WL_AKEY,
			'redirect_uri'=>WL_BACK.'?connect=live&action=callback',
			'scope'=>'wl.signin wl.basic wl.emails'
		);
		header('Location:https://login.live.com/oauth20_authorize.srf?'.http_build_query($params));
		exit();
	} 
	function open_callback($code) {
		$params=array(
			'grant_type'=>'authorization_code',
			'code'=>$code,
			'client_id'=>WL_AKEY,
			'client_secret'=>WL_SKEY,
			'redirect_uri'=>WL_BACK.'?connect=live&action=callback'
		);
		$str = open_connect_http('https://login.live.com/oauth20_token.srf', http_build_query($params), 'POST');
		$_SESSION["access_token"] = $str["access_token"];
	}
	function open_new_user(){
		$user = open_connect_http("https://apis.live.net/v5.0/me");
		$_SESSION['open_id'] = $user["id"];
		return array(
			'nickname' => $user["name"],
			'display_name' => $user["name"],
			'user_url' => 'https://profile.live.com/cid-'.$_SESSION['open_id'],
			'user_email' => $user['emails']['preferred']//this on is real too
		);
	}
} 

class DOUBAN_CLASS {
	function open_login() {
		$params=array(
			'response_type'=>'code',
			'client_id'=>DB_AKEY,
			'redirect_uri'=>DB_BACK,
			'scope'=>'shuo_basic_r,shuo_basic_w,douban_basic_common',
			'state'=>md5(time())
		);
		header('Location:https://www.douban.com/service/auth2/auth?'.http_build_query($params));
		exit();
	} 
	function open_callback($code) {
		$params=array(
			'grant_type'=>'authorization_code',
			'code'=>$code,
			'client_id'=>DB_AKEY,
			'client_secret'=>DB_SKEY,
			'redirect_uri'=>DB_BACK
		);
		$str = open_connect_http('https://www.douban.com/service/auth2/token', http_build_query($params), 'POST');
		$_SESSION["access_token"] = $str["access_token"];
		$_SESSION['open_id'] = $str["douban_user_id"];
	}
	function open_new_user(){
		$user = open_connect_http("https://api.douban.com/v2/user/~me?access_token=".$_SESSION["access_token"]);
		return array(
			'nickname' => $user['name'],
			'display_name' => $user['name'],
			'user_url' => 'http://www.douban.com/people/'.$_SESSION['open_id'].'/',
			'user_email' => $_SESSION['open_id'].'@douban.com'//fake
		);
	}
} 

class RENREN_CLASS {
	function open_login() {
		$params=array(
			'response_type'=>'code',
			'client_id'=>RR_AKEY,
			'redirect_uri'=>RR_BACK.'?connect=renren&action=callback',
			'scope'=>'status_update read_user_status'
		);
		header('Location:https://graph.renren.com/oauth/authorize?'.http_build_query($params));
		exit();
	} 
	function open_callback($code) {
		$params=array(
			'grant_type'=>'authorization_code',
			'code'=>$code,
			'client_id'=>RR_AKEY,
			'client_secret'=>RR_SKEY,
			'redirect_uri'=>RR_BACK.'?connect=renren&action=callback'
		);
		$str = open_connect_http('https://graph.renren.com/oauth/token', http_build_query($params), 'POST');
		$_SESSION["access_token"] = $str["access_token"];
		$_SESSION['open_id'] = $str["user"]["id"];
	}
	function open_new_user(){
		$user = open_connect_http("https://api.renren.com/v2/user/login/get?access_token=".$_SESSION["access_token"]);
		$_SESSION['open_img'] = $user['response']["avatar"][1]['url'];
		return array(
			'nickname' => $user['response']['name'],
			'display_name' => $user['response']['name'],
			'user_url' => 'http://www.renren.com/'.$_SESSION['open_id'].'/profile',
			'user_email' => $_SESSION['open_id'].'@renren.com'//fake
		);
	}
} 

class KAIXIN_CLASS {
	function open_login() {
		$params=array(
			'response_type'=>'code',
			'client_id'=>KX_AKEY,
			'redirect_uri'=>KX_BACK.'?connect=kaixin&action=callback',
			'scope'=>'basic'
		);
		header('Location:http://api.kaixin001.com/oauth2/authorize?'.http_build_query($params));
		exit();
	} 
	function open_callback($code) {
		$params=array(
			'grant_type'=>'authorization_code',
			'code'=>$code,
			'client_id'=>KX_AKEY,
			'client_secret'=>KX_SKEY,
			'redirect_uri'=>KX_BACK.'?connect=kaixin&action=callback'
		);
		$str = open_connect_http('https://api.kaixin001.com/oauth2/access_token', http_build_query($params), 'POST');
		$_SESSION["access_token"] = $str["access_token"];
	}
	function open_new_user(){
		$user = open_connect_http("https://api.kaixin001.com/users/me?access_token=".$_SESSION["access_token"]);
		$_SESSION['open_id'] = $user["uid"];
		$_SESSION['open_img'] = $user['logo50'];
		return array(
			'nickname' => $user['name'],
			'display_name' => $user['name'],
			'user_url' => 'http://www.kaixin001.com/home/'.$_SESSION['open_id'].'.html',
			'user_email' => $_SESSION['open_id'].'@kaixin.com'//fake
		);
	}
} 

class XIAOMI_CLASS {
	function open_login() {
		$params=array(
			'response_type'=>'code',
			'client_id'=>XM_AKEY,
			'redirect_uri'=>XM_BACK.'?connect=xiaomi&action=callback',
			'state'=>'state',
			'scope'=>''
		);
		header('Location:https://account.xiaomi.com/oauth2/authorize?'.http_build_query($params));
		exit();
	} 
	function open_callback($code) {
		$params=array(
			'grant_type'=>'authorization_code',
			'code'=>$code,
			'client_id'=>XM_AKEY,
			'client_secret'=>XM_SKEY,
			'redirect_uri'=>XM_BACK.'?connect=xiaomi&action=callback',
			'token_type'=>'mac'
		);
		$str = open_connect_http('https://account.xiaomi.com/oauth2/token?'.http_build_query($params));
		$_SESSION["access_token"] = $str["access_token"];
		$_SESSION["mac_key"] = $str["mac_key"];
	}
	function open_new_user(){
        list($usec, $sec) = explode(' ', microtime());
        $nonce = (float)mt_rand();
        $minutes = (int)($sec / 60);
        $nonce = $nonce.":".$minutes;
        $signString = $nonce."\nGET\nopen.account.xiaomi.com\n/user/profile\nclientId=".XM_AKEY."&token=".$_SESSION["access_token"]."\n";
		$sign = urlencode(base64_encode(hash_hmac('sha1', $signString, $_SESSION["mac_key"], true)));
        $head = array('Authorization:MAC access_token="'.$_SESSION["access_token"].'", nonce="'.$nonce.'",mac="'.$sign.'"');
		$user = open_connect_http("https://open.account.xiaomi.com/user/profile?clientId=".XM_AKEY."&token=".$_SESSION["access_token"],'','GET',$head);
		$_SESSION['open_id'] = $user['data']['userId'];
		//$_SESSION['open_img'] = $user['data']['miliaoIcon'];
		unset($_SESSION["mac_key"]);
		return array(
			'nickname' => $user['data']['aliasNick'],
			'display_name' => $user['data']['miliaoNick'],
			'user_url' => 'http://www.miui.com/space-uid-'.$_SESSION['open_id'].'.html',
			'user_email' => $_SESSION['open_id'].'@xiaomi.com'//fake
		);
	}
} 

function open_close($open_info){
	wp_die($open_info);
	exit();
}

function open_isbind($open_id) {
	global $wpdb;
	$sql = "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = '%s' AND meta_value = '%s'";
	return $wpdb -> get_var($wpdb -> prepare($sql, 'open_id', $open_id));
} 

function open_unbind(){
	if (is_user_logged_in()) {
		$user = wp_get_current_user();
		delete_user_meta($user -> ID, 'open_type');
		delete_user_meta($user -> ID, 'open_img');
		delete_user_meta($user -> ID, 'open_id');
		delete_user_meta($user -> ID, 'open_access_token');
	}
	echo '<script>opener.window.focus();opener.window.location.reload();window.close();</script>';
	exit;
}

function open_action($os){
	if (!isset($_SESSION['open_id'])) $newuser = $os -> open_new_user();
	if (!$_SESSION['open_id'] || !OPEN_TYPE) return;
	if (is_user_logged_in()) {
		$wpuid = get_current_user_id();
		if (open_isbind($_SESSION['open_id'])) {
			open_close($GLOBALS['open_str']['err_other_openid']);
		}else{
			$open_id = get_user_meta($wpuid, 'open_id', true);
			if ($open_id) open_close($GLOBALS['open_str']['err_other_user']);
		}
	} else {
		$wpuid = open_isbind($_SESSION['open_id']);
		if (!$wpuid) {
			$wpuid = username_exists(strtoupper(OPEN_TYPE).$_SESSION['open_id']);
			if(!$wpuid){
				$userdata = array(
					'user_pass' => wp_generate_password(),
					'user_login' => strtoupper(OPEN_TYPE).$_SESSION['open_id'],
					'show_admin_bar_front' => 'false'
				);
				if(!isset($newuser)) $newuser = $os -> open_new_user();
				$userdata = array_merge($userdata, $newuser);
				if(email_exists($userdata['user_email'])) open_close($GLOBALS['open_str']['err_other_email']);//Google,Live
				if(!function_exists('wp_insert_user')){
					include_once( ABSPATH . WPINC . '/registration.php' );
				} 
				$wpuid = wp_insert_user($userdata);
			}
		} 
	} 
	if($wpuid){
		update_user_meta($wpuid, 'open_type', OPEN_TYPE);
		if(isset($_SESSION['open_img'])) update_user_meta($wpuid, 'open_img', $_SESSION['open_img']);
		update_user_meta($wpuid, 'open_id', $_SESSION['open_id']);
		update_user_meta($wpuid, 'open_access_token', $_SESSION["access_token"]);
		wp_set_auth_cookie($wpuid, true, false);
		wp_set_current_user($wpuid);
	}
	unset($_SESSION['open_id']);
	unset($_SESSION["access_token"]);
	if(isset($_SESSION['open_img'])) unset($_SESSION['open_img']); 
	if(isset($_SESSION['state'])) unset($_SESSION['state']); 
	if(!isset($_SESSION['back'])) $_SESSION['back'] = home_url(); 
	echo '<script>
			if(/iPhone/.test(navigator.userAgent)){
				location.href="'.$_SESSION['back'].'";
			}else{
				opener.window.focus();
				opener.window.location.href="'.$_SESSION['back'].'";
				window.close();
			}
		</script>';
	exit;
}

//post api (test for now)
function open_update_test($text){
	$params=array(
		'status'=>$text
	);
	$re = open_connect_api('https://api.weibo.com/2/statuses/update.json', $params, 'POST');
	echo '<script>alert("ok");opener.window.focus();window.close();</script>';
	exit;
}

function open_connect_api($url, $params=array(), $method='GET'){
	$user = wp_get_current_user();
	$access_token = get_user_meta($user -> ID, 'open_access_token', true);
	if($access_token){
		$params['access_token']=$access_token;
		if($method=='GET'){
			$result=open_connect_http($url.'?'.http_build_query($params));
		}else{
			$result=open_connect_http($url, http_build_query($params), 'POST');
		}
		return $result;	
	}
}

function open_connect_http($url, $postfields='', $method='GET', $headers=array()){
	$ci=curl_init();
	curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ci, CURLOPT_HEADER, false);
	curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ci, CURLOPT_TIMEOUT, 30);
	if($method=='POST'){
		curl_setopt($ci, CURLOPT_POST, TRUE);
		if($postfields!='')curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
	}
	if(!$headers && isset($_SESSION["access_token"])){
		$headers[]='Authorization: Bearer '.$_SESSION["access_token"];
	}
	$headers[] = 'User-Agent: Open Social Login for China(xiaomac.com)';
	$headers[] = 'Expect:';
	curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ci, CURLOPT_URL, $url);
	$response=curl_exec($ci);
	curl_close($ci);
	$json_r=array();
	if(strpos($response,'&&&START&&&')===0)$response = str_replace("&&&START&&&","",$response);
	if($response!='')$json_r=json_decode($response, true);
	return $json_r;
}

function open_check_url($url){
	$headers = @get_headers($url);
	if (!preg_match("|200|", $headers[0])) {
		return FALSE;
	} else {
		return TRUE;
	}
}

//activate
register_activation_hook( __FILE__, 'open_social_activation' );
function open_social_activation(){
	$osop = get_option('osop');
	if(!$osop) update_option('osop', array(
		'show_login_form'	=> 1,
		'show_login_page'	=> 0,
		'show_share_content'=> 0,
		'share_sina_user' 	=> '',
		'share_qqt_appkey'	=> '',
		'share_qq_email'	=> '',
		'share_qq_talk'		=> '',
		'delete_setting'	=> 0
	));
}
//uninstall
register_uninstall_hook( __FILE__, 'open_social_uninstall' );
function open_social_uninstall(){
	$osop = get_option('osop');
	if($osop && isset($osop['delete_setting']) && $osop['delete_setting']==1) delete_option('osop');
}

//admin_init
add_action( 'admin_init', 'open_social_admin_init' );
function open_social_admin_init() {
	register_setting( 'open_social_options_group', 'osop' );
}

//setting link 
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'open_settings_link' );
function open_settings_link($links) {
	array_unshift($links, '<a href="options-general.php?page='.plugin_basename(__FILE__).'">'.__('Settings').'</a>');
	return $links;
}

//setting menu
add_action('admin_menu', 'open_options_add_page');
function open_options_add_page() {
    if(!current_user_can('manage_options')){
	    remove_menu_page('index.php'); 
    }else{
		add_options_page($GLOBALS['open_str']['setting_menu'], $GLOBALS['open_str']['setting_menu'], 'manage_options', plugin_basename(__FILE__), 'open_options_page');
	}
}

//setting page
function open_options_page() {
	if (isset($_POST['submit'])) {
		$cachefile = dirname(__FILE__) . '/setting.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\n";
		$s .= "define('QQ_AKEY','".esc_attr($_POST['QQ_AKEY'])."');\n";
		$s .= "define('QQ_SKEY','".esc_attr($_POST['QQ_SKEY'])."');\n";
		$s .= "define('QQ_BACK','".esc_attr($_POST['QQ_BACK'])."');\n";
		$s .= "define('WB_AKEY','".esc_attr($_POST['WB_AKEY'])."');\n";
		$s .= "define('WB_SKEY','".esc_attr($_POST['WB_SKEY'])."');\n";
		$s .= "define('WB_BACK','".esc_attr($_POST['WB_BACK'])."');\n";
		$s .= "define('BD_AKEY','".esc_attr($_POST['BD_AKEY'])."');\n";
		$s .= "define('BD_SKEY','".esc_attr($_POST['BD_SKEY'])."');\n";
		$s .= "define('BD_BACK','".esc_attr($_POST['BD_BACK'])."');\n";
		$s .= "define('GG_AKEY','".esc_attr($_POST['GG_AKEY'])."');\n";
		$s .= "define('GG_SKEY','".esc_attr($_POST['GG_SKEY'])."');\n";
		$s .= "define('GG_BACK','".esc_attr($_POST['GG_BACK'])."');\n";
		$s .= "define('WL_AKEY','".esc_attr($_POST['WL_AKEY'])."');\n";
		$s .= "define('WL_SKEY','".esc_attr($_POST['WL_SKEY'])."');\n";
		$s .= "define('WL_BACK','".esc_attr($_POST['WL_BACK'])."');\n";
		$s .= "define('DB_AKEY','".esc_attr($_POST['DB_AKEY'])."');\n";
		$s .= "define('DB_SKEY','".esc_attr($_POST['DB_SKEY'])."');\n";
		$s .= "define('DB_BACK','".esc_attr($_POST['DB_BACK'])."');\n";
		$s .= "define('RR_AKEY','".esc_attr($_POST['RR_AKEY'])."');\n";
		$s .= "define('RR_SKEY','".esc_attr($_POST['RR_SKEY'])."');\n";
		$s .= "define('RR_BACK','".esc_attr($_POST['RR_BACK'])."');\n";
		$s .= "define('KX_AKEY','".esc_attr($_POST['KX_AKEY'])."');\n";
		$s .= "define('KX_SKEY','".esc_attr($_POST['KX_SKEY'])."');\n";
		$s .= "define('KX_BACK','".esc_attr($_POST['KX_BACK'])."');\n";
		$s .= "define('XM_AKEY','".esc_attr($_POST['XM_AKEY'])."');\n";
		$s .= "define('XM_SKEY','".esc_attr($_POST['XM_SKEY'])."');\n";
		$s .= "define('XM_BACK','".esc_attr($_POST['XM_BACK'])."');\n";
		$s .= "?>\n";
		fwrite($fp, $s);
		fclose($fp);
		echo "<script>location.reload();</script>";
	}?> 
	<div class="wrap">
		<h2><?php echo $GLOBALS['open_str']['setting_menu']?></h2>
		<form action="options.php" method="post">
		<?php settings_fields( 'open_social_options_group' ); ?>
		<?php $osop = get_option('osop'); ?>
		<table class="form-table">
		<tr valign="top">
		<th scope="row"><?php echo $GLOBALS['open_str']['osop_login_button']?><br/>
			<a href="<?php echo admin_url('widgets.php');?>"><?php echo __('Widgets');?></a></th>
		<td><label for="osop[show_login_form1]"><input name="osop[show_login_form]" id="osop[show_login_form1]" type="radio" value="1" <?php checked($osop['show_login_form'],1);?> /> <?php echo $GLOBALS['open_str']['osop_show_login_form1']?>  
		<label for="osop[show_login_form2]"><input name="osop[show_login_form]" id="osop[show_login_form2]" type="radio" value="2" <?php checked($osop['show_login_form'],2);?> /> <?php echo $GLOBALS['open_str']['osop_show_login_form2']?></label>  
		<label for="osop[show_login_form0]"><input name="osop[show_login_form]" id="osop[show_login_form0]" type="radio" value="0" <?php checked($osop['show_login_form'],0);?> /> <?php echo $GLOBALS['open_str']['osop_show_login_form0']?></label><br/>
		<label for="osop[show_login_page]"><input name="osop[show_login_page]" id="osop[show_login_page]" type="checkbox" value="1" <?php checked($osop['show_login_page'],1);?> /> <?php echo $GLOBALS['open_str']['osop_show_login_page']?></label>
		</td>
		</tr>
		<tr valign="top">
		<th scope="row"><?php echo $GLOBALS['open_str']['osop_share_button']?><br/>
			<a href="<?php echo admin_url('widgets.php');?>"><?php echo __('Widgets');?></a></th>
		<td><label for="osop[show_share_content]"><input name="osop[show_share_content]" id="osop[show_share_content]" type="checkbox" value="1" <?php checked($osop['show_share_content'],1);?> />
			<?php echo $GLOBALS['open_str']['osop_show_share_content']?></label><br />
			<input name="osop[share_sina_user]" id="osop[share_sina_user]" class="regular-text" value="<?php echo $osop['share_sina_user']?>" />
			<a href="http://open.weibo.com/sharebutton" target="_blank"><?php echo $GLOBALS['open_str']['osop_share_sina_user']?></a><br/>
			<input name="osop[share_qqt_appkey]" id="osop[share_qqt_appkey]" class="regular-text" value="<?php echo $osop['share_qqt_appkey']?>" />
			<a href="http://dev.t.qq.com/websites/share/" target="_blank"><?php echo $GLOBALS['open_str']['osop_share_qqt_appkey']?></a> <br/>
			<input name="osop[share_qq_email]" id="osop[share_qq_email]" class="regular-text" value="<?php echo $osop['share_qq_email']?>" />
			<a href="http://open.mail.qq.com/" target="_blank"><?php echo $GLOBALS['open_str']['osop_share_qq_email']?></a> <br/>
			<input name="osop[share_qq_talk]" id="osop[share_qq_talk]" class="regular-text" value="<?php echo $osop['share_qq_talk']?>" />
			<a href="http://shang.qq.com/widget/set.php" target="_blank"><?php echo $GLOBALS['open_str']['osop_share_qq_talk']?></a> 
		</td>
		</tr>
		<tr valign="top">
		<th scope="row"></th>
		<td><label for="osop[delete_setting]"><input name="osop[delete_setting]" id="osop[delete_setting]" type="checkbox" value="1" <?php checked($osop['delete_setting'],1);?> /> <?php echo $GLOBALS['open_str']['osop_delete_setting']?></label>
			<?php submit_button();?>
		</td>
		</tr>
		</table>
		</form>
	</div>

	<div class="wrap">
		<form method="post">
		<h2><?php echo $GLOBALS['open_str']['setting_menu_adv']?></h2>
		<table class="form-table">
		<tr valign="top">
		<th scope="row"><a href="http://connect.qq.com/" target="_blank"><?php echo $GLOBALS['open_str']['qq']?></a>
			<a href="http://wiki.connect.qq.com/" target="_blank">?</a></th>
		<td><input name="QQ_AKEY" value="<?php echo (defined("QQ_AKEY")?QQ_AKEY:'');?>" class="regular-text" /> APP ID <br/>
			<input name="QQ_SKEY" value="<?php echo (defined("QQ_SKEY")?QQ_SKEY:'');?>" class="regular-text" /> APP KEY <br/>
			<input name="QQ_BACK" value="<?php echo (defined("QQ_BACK")?QQ_BACK:'');?>" class="regular-text code" placeholder="<?php echo home_url('/')?>" />
			<?php echo $GLOBALS['open_str']['callback']?> </td>
		</tr>
		<tr valign="top">
		<th scope="row"><a href="http://open.weibo.com/" target="_blank"><?php echo $GLOBALS['open_str']['sina']?></a>
			<a href="http://open.weibo.com/wiki/" target="_blank">?</a></th>
		<td><input name="WB_AKEY" value="<?php echo (defined("WB_AKEY")?WB_AKEY:'');?>" class="regular-text" /> App Key <br/>
			<input name="WB_SKEY" value="<?php echo (defined("WB_SKEY")?WB_SKEY:'');?>" class="regular-text" /> App Secret<br/>
			<input name="WB_BACK" value="<?php echo (defined("WB_BACK")?WB_BACK:'');?>" class="regular-text code" placeholder="<?php echo home_url('/')?>" />
			<?php echo $GLOBALS['open_str']['callback']?></td>
		</tr>
		<tr valign="top">
		<th scope="row"><a href="http://developer.baidu.com/console" target="_blank"><?php echo $GLOBALS['open_str']['baidu']?></a>
			<a href="http://developer.baidu.com/wiki/index.php?title=docs/oauth" target="_blank">?</a></th>
		<td><input name="BD_AKEY" value="<?php echo (defined("BD_AKEY")?BD_AKEY:'');?>" class="regular-text" /> API Key <br/>
			<input name="BD_SKEY" value="<?php echo (defined("BD_SKEY")?BD_SKEY:'');?>" class="regular-text" /> Secret Key <br/>
			<input name="BD_BACK" value="<?php echo (defined("BD_BACK")?BD_BACK:'');?>" class="regular-text code" placeholder="<?php echo home_url('/')?>" />
			<?php echo $GLOBALS['open_str']['callback']?> </td>
		</tr>
		<tr valign="top">
		<th scope="row"><a href="https://cloud.google.com/console" target="_blank"><?php echo $GLOBALS['open_str']['google']?></a>
			<a href="https://developers.google.com/accounts/docs/OAuth2WebServer" target="_blank">?</a></th>
		<td><input name="GG_AKEY" value="<?php echo (defined("GG_AKEY")?GG_AKEY:'');?>" class="regular-text" /> CLIENT ID <br/>
			<input name="GG_SKEY" value="<?php echo (defined("GG_SKEY")?GG_SKEY:'');?>" class="regular-text" /> CLIENT SECRET <br/>
			<input name="GG_BACK" value="<?php echo (defined("GG_BACK")?GG_BACK:'');?>" class="regular-text code" placeholder="<?php echo home_url('/')?>" /> 
			REDIRECT URI </td>
		</tr>
		<tr valign="top">
		<th scope="row"><a href="https://account.live.com/developers/applications" target="_blank"><?php echo $GLOBALS['open_str']['live']?></a>
			<a href="http://msdn.microsoft.com/en-us/library/live/ff621314.aspx" target="_blank">?</a></th>
		<td><input name="WL_AKEY" value="<?php echo (defined("WL_AKEY")?WL_AKEY:'');?>" class="regular-text" /> Client ID <br/>
			<input name="WL_SKEY" value="<?php echo (defined("WL_SKEY")?WL_SKEY:'');?>" class="regular-text" /> Client secret <br/>
			<input name="WL_BACK" value="<?php echo (defined("WL_BACK")?WL_BACK:'');?>" class="regular-text code" placeholder="<?php echo home_url('/')?>" /> Redirect domain <br/></td>
		</tr>
		<tr valign="top">
		<th scope="row"><a href="http://developers.douban.com/" target="_blank"><?php echo $GLOBALS['open_str']['douban']?></a>
			<a href="http://developers.douban.com/wiki/?title=oauth2" target="_blank">?</a></th>
		<td><input name="DB_AKEY" value="<?php echo (defined("DB_AKEY")?DB_AKEY:'');?>" class="regular-text" /> API Key <br/>
			<input name="DB_SKEY" value="<?php echo (defined("DB_SKEY")?DB_SKEY:'');?>" class="regular-text" /> Secret <br/>
			<input name="DB_BACK" value="<?php echo (defined("DB_BACK")?DB_BACK:'');?>" class="regular-text code" placeholder="<?php echo home_url('/')?>" />
			<?php echo $GLOBALS['open_str']['callback']?> <br/></td>
		</tr>
		<tr valign="top">
		<th scope="row"><a href="http://dev.renren.com/" target="_blank"><?php echo $GLOBALS['open_str']['renren']?></a>
			<a target="_blank" href="http://wiki.dev.renren.com/wiki/Authentication">?</a></th>
		<td><input name="RR_AKEY" value="<?php echo (defined("RR_AKEY")?RR_AKEY:'');?>" class="regular-text" /> APP KEY <br/>
			<input name="RR_SKEY" value="<?php echo (defined("RR_SKEY")?RR_SKEY:'');?>" class="regular-text" /> Secret Key <br/>
			<input name="RR_BACK" value="<?php echo (defined("RR_BACK")?RR_BACK:'');?>" class="regular-text code" placeholder="<?php echo home_url('/')?>" />
			<?php echo $GLOBALS['open_str']['callback']?> <br/></td>
		</tr>
		<tr valign="top">
		<th scope="row"><a href="http://open.kaixin001.com/" target="_blank"><?php echo $GLOBALS['open_str']['kaixin']?></a>
			<a href="http://open.kaixin001.com/document.php" target="_blank">?</a></th>
		<td><input name="KX_AKEY" value="<?php echo (defined("KX_AKEY")?KX_AKEY:'');?>" class="regular-text" /> API Key <br/>
			<input name="KX_SKEY" value="<?php echo (defined("KX_SKEY")?KX_SKEY:'');?>" class="regular-text" /> Secret Key <br/>
			<input name="KX_BACK" value="<?php echo (defined("KX_BACK")?KX_BACK:'');?>" class="regular-text code" placeholder="<?php echo home_url('/')?>" />
			<?php echo $GLOBALS['open_str']['callback']?> <br/>
		</td>
		</tr>
		<tr valign="top">
		<th scope="row"><a href="http://dev.xiaomi.com/" target="_blank"><?php echo $GLOBALS['open_str']['xiaomi']?></a>
			<a href="http://dev.xiaomi.com/doc/" target="_blank">?</a></th>
		<td><input name="XM_AKEY" value="<?php echo (defined("XM_AKEY")?XM_AKEY:'');?>" class="regular-text" /> AppID <br/>
			<input name="XM_SKEY" value="<?php echo (defined("XM_SKEY")?XM_SKEY:'');?>" class="regular-text" /> AppSecret <br/>
			<input name="XM_BACK" value="<?php echo (defined("XM_BACK")?XM_BACK:'');?>" class="regular-text code" placeholder="<?php echo home_url('/')?>" />
			<?php echo $GLOBALS['open_str']['callback']?> 
			<?php submit_button();?>
		</td>
		</tr>
		</table>
		</form>
	</div>
	<div class="wrap">
		<h2><?php echo $GLOBALS['open_str']['about_title']?></h2>
		<p><?php echo $GLOBALS['open_str']['about_info']?>, 
		<a href="https://me.alipay.com/playes" target="_blank"><?php echo $GLOBALS['open_str']['about_alipay']?></a>, 
		<a href="http://www.xiaomac.com/" target="_blank"><?php echo $GLOBALS['open_str']['about_link']?></a>,  
		<a href="http://wordpress.org/plugins/open-social/" target="_blank"><?php echo $GLOBALS['open_str']['about_plugin']?></a> :)</p>
		<p><code>&lt;a href=&quot;http://www.xiaomac.com/&quot; target=&quot;_blank&quot;&gt;XiaoMac&lt;/a&gt;</code></p>
	</div>
	<?php
} 

//user avatar
add_filter("get_avatar", "open_get_avatar",10,4);
function open_get_avatar($avatar, $id_or_email='',$size='80') {
	global $comment;
	if($id_or_email){
		if(is_object($id_or_email)) $id_or_email = $id_or_email->user_id;
	}else{
		if(is_object($comment)) $id_or_email = $comment->user_id;
	}
	if($id_or_email) $open_type = get_user_meta($id_or_email, 'open_type', true);
	if(isset($open_type)){
		$open_id = get_user_meta($id_or_email, 'open_id', true);
		if($open_type=='qq'){
			$out = 'http://q.qlogo.cn/qqapp/'.QQ_AKEY.'/'.$open_id.'/100';//40
		}elseif($open_type=='sina'){
			$out = 'http://tp3.sinaimg.cn/'.$open_id.'/180/1.jpg';//50
		}elseif($open_type=='baidu'){
			$out = 'http://himg.bdimg.com/sys/portrait/item/'.$open_id.'.jpg';//portraitn
		}elseif($open_type=='douban'){
			$out = 'http://img3.douban.com/icon/ul'.$open_id.'.jpg';//u
		}elseif($open_type=='google'){
			$out = 'http://www.google.com/s2/photos/profile/'.$open_id.'?sz=100';
		}elseif($open_type=='xiaomi'){
			$out = 'http://avatar.bbs.miui.com/data/avatar/'.substr((strlen($open_id)<=8?'0'.$open_id:$open_id),0,-6).'/'.substr($open_id,-6,-4).'/'.substr($open_id,-4,-2).'/'.substr($open_id,-2).'_avatar_middle.jpg';
		}elseif($open_type=='renren'||$open_type=='kaixin'){
			$out = get_user_meta($id_or_email, 'open_img', true);
			if($open_type=='kaixin') $out = str_replace('/50_','/120_',$out);
			if($open_type=='renren') $out = str_replace('/tiny_','/head_',$out);
		}
		if(isset($open_id) && isset($out)) $avatar = "<img alt='' src='{$out}' class='avatar avatar-{$size}' width='{$size}' />";
	}
	return $avatar;
}

//login form
$osop = get_option('osop');
if($osop && isset($osop['show_login_page']) && $osop['show_login_page']==1) add_action('login_form', 'open_social_login_form');
if($osop && isset($osop['show_login_form']) && $osop['show_login_form']==1) add_action('comment_form_top', 'open_social_login_form');
if($osop && isset($osop['show_login_form']) && $osop['show_login_form']==2) add_action('comment_form', 'open_social_login_form');
add_action('comment_form_must_log_in_after', 'open_social_login_form');
function open_social_login_form($login_type='') {
	if (!is_user_logged_in() || $login_type=='bind'){
		$html = '<div id="open_social_login" class="login_box">';
		if(defined("QQ_AKEY")&&QQ_AKEY) $html .= open_login_button_show('qq',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['qq'],$GLOBALS['open_str']['login']));
		if(defined("WB_AKEY")&&WB_AKEY) $html .= open_login_button_show('sina',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['sina'],$GLOBALS['open_str']['login']));
		if(defined("BD_AKEY")&&BD_AKEY) $html .= open_login_button_show('baidu',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['baidu'],$GLOBALS['open_str']['login']));
		if(defined("GG_AKEY")&&GG_AKEY) $html .= open_login_button_show('google',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['google'],$GLOBALS['open_str']['login']));
		if(defined("WL_AKEY")&&WL_AKEY) $html .= open_login_button_show('live',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['live'],$GLOBALS['open_str']['login']));
		if(defined("DB_AKEY")&&DB_AKEY) $html .= open_login_button_show('douban',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['douban'],$GLOBALS['open_str']['login']));
		if(defined("RR_AKEY")&&RR_AKEY) $html .= open_login_button_show('renren',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['renren'],$GLOBALS['open_str']['login']));
		if(defined("KX_AKEY")&&KX_AKEY) $html .= open_login_button_show('kaixin',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['kaixin'],$GLOBALS['open_str']['login']));
		if(defined("XM_AKEY")&&XM_AKEY) $html .= open_login_button_show('xiaomi',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['xiaomi'],$GLOBALS['open_str']['login']));
		$html .= '</div>';
		echo $html;
	}
} 

if($osop && isset($osop['show_share_content']) && $osop['show_share_content']==1) add_filter('the_content', 'open_social_share_form');
function open_social_share_form($content) {
	if(is_single()) {
		$osop = get_option('osop');
		$content .= '<div class="share_box">';
		$content .= open_share_button_show('weibo',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_weibo'],$GLOBALS['open_str']['share']),"http://v.t.sina.com.cn/share/share.php?url=%URL%&title=%TITLE%&appkey=".WB_AKEY."&ralateUid=".$osop['share_sina_user']."&language=zh_cn&searchPic=true");
		$content .= open_share_button_show('qzone',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_qzone'],$GLOBALS['open_str']['share']),"http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=%URL%&title=%TITLE%&desc=&summary=&site=");
		$content .= open_share_button_show('qqt',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_qqt'],$GLOBALS['open_str']['share']),"http://share.v.t.qq.com/index.php?c=share&amp;a=index&url=%URL%&title=%TITLE%&appkey=".$osop['share_qqt_appkey']);
		$content .= open_share_button_show('youdao',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_youdao'],$GLOBALS['open_str']['share']),"http://note.youdao.com/memory/?url=%URL%&title=%TITLE%&sumary=&pic=&product=");
		$content .= open_share_button_show('weixin',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_weixin'],$GLOBALS['open_str']['share']),"http://chart.apis.google.com/chart?chs=400x400&cht=qr&chld=L|5&chl=%URL%");
		$content .= open_share_button_show('twitter',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_twitter'],$GLOBALS['open_str']['share']),"http://twitter.com/home/?status=%TITLE%:%URL%");
		$content .= open_share_button_show('facebook',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_facebook'],$GLOBALS['open_str']['share']),"http://www.facebook.com/sharer.php?u=%URL%&amp;t=%TITLE%");
		$content .= '</div>';
	}
	return $content;
} 

//hide user option
add_action('admin_head','open_social_hide_option');
function open_social_hide_option(){
	if(!is_user_logged_in()) return;
	$current_user = wp_get_current_user();
	$m = $current_user->user_email;
	$open_type = get_user_meta($current_user -> ID, 'open_type', true);
	if(!current_user_can('manage_options') && $open_type && (strpos($m,'@t.qq.com')||strpos($m,'@weibo.com')||strpos($m,'@baidu.com')||strpos($m,'@douban.com')||strpos($m,'@renren.com')||strpos($m,'@kaixin.com')||strpos($m,'@xiaomi.com')) ){
		//not admin, had bound, have fake email
		echo "<script>jQuery(document).ready(function($){
				$('#wpfooter').hide();
				$('#wp-admin-bar-wp-logo').hide();
				$('#collapse-menu').hide();
				$('#screen-meta-links').hide();
				$('h3:not(:eq(2))').hide();
				$('table.form-table:not(:eq(2))').hide();
				//if(/updated=1/.test(window.location.href))setTimeout(function(){location.href='/';},1200);
			});</script>";
	}
}

//binding
add_action('personal_options', 'open_social_bind_options');
function open_social_bind_options() {
	$user_id = get_current_user_id();
	if(isset($_GET['user_id']) && $user_id!=$_GET['user_id']) return;
	echo '<tr><th scope="row"></th><td>';
	$open_type = get_user_meta($user_id, 'open_type', true);
	if ($open_type) {
		echo '<input class="button-primary" type="button" onclick=\'window.open("'.home_url('/').'?connect='.$open_type.'&action=unbind", "xmOpenWindow","width=500,height=350,menubar=0,scrollbars=1,resizable=1,status=1,titlebar=0,toolbar=0,location=0");return false;\' value="'.str_replace('%OPEN_TYPE%',strtoupper($open_type),$GLOBALS['open_str']['unbind']).'"/> ';
	} else {
		open_social_login_form('bind');
	} 
	echo '</td></tr>';
} 

//script & style
add_action( 'wp_enqueue_scripts', 'open_social_style' );
add_action( 'login_enqueue_scripts', 'open_social_style' );
add_action( 'admin_enqueue_scripts', 'open_social_style' );
function open_social_style() {
	wp_register_style( 'open_social_css', plugins_url('/images/os.css', __FILE__) );
	wp_enqueue_style( 'open_social_css' );
	wp_register_script( 'open_social_js', plugins_url('/images/os.js', __FILE__), array( 'jquery','jquery-ui-tooltip' ), true );
	wp_enqueue_script( 'open_social_js');
}
function open_login_button_show($icon_type,$icon_title){
	return "<div class=\"login_button login_icon_$icon_type\" onclick=\"login_button_click('$icon_type')\" title=\"$icon_title\"></div>";
}
function open_share_button_show($icon_type,$icon_title,$icon_link){
	return "<div class=\"share_button share_icon_$icon_type\" onclick=\"share_button_click('$icon_link')\" title=\"$icon_title\"></div>";
}
function open_tool_button_show($icon_type,$icon_title,$icon_link){//local
	return "<div class=\"share_button share_icon_$icon_type\" onclick=\"location.href='$icon_link';\" title=\"$icon_title\"></div>";
}
function open_lang_button_show($icon_type,$icon_title,$icon_link){//world
	return "<div class=\"lang_button\" onclick=\"location.href='$icon_link';\" title=\"$icon_title\"><img src=\"".plugins_url('images/lang_button/'.$icon_type.'.gif', __FILE__)."\" width=\"20\" height=\"20\" /></div>";
}

//shortcode
add_shortcode('os_hide', 'open_social_hide');
function open_social_hide($atts, $content=""){
	$output = '';
	if(is_user_logged_in()){
		$output .= '<span class=os_show><p>'.trim($content).'</p></span>';
	}else{
		$output .= '<p class=os_hide>'.$GLOBALS['open_str']['open_social_hide_text'].'</p>';
	}
	return $output;
}

//widget
add_action('widgets_init', create_function('', 'return register_widget("open_social_login_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("open_social_share_widget");'));

class open_social_login_widget extends WP_Widget {
    function open_social_login_widget() {
        parent::WP_Widget(false, $name = $GLOBALS['open_str']['widget_title'], array( 'description' => $GLOBALS['open_str']['widget_desc'], ) );
    }
	function form($instance) {
		if($instance) {
			$title = $instance['title'];
			$qq = esc_attr($instance['qq']);
			$sina = esc_attr($instance['sina']);
			$baidu = esc_attr($instance['baidu']);
			$google = esc_attr($instance['google']);
			$live = esc_attr($instance['live']);
			$douban = esc_attr($instance['douban']);
			$renren = esc_attr($instance['renren']);
			$kaixin = esc_attr($instance['kaixin']);
			$xiaomi = esc_attr($instance['xiaomi']);
		} else {
			$title = '';
		    $qq = $sina = $baidu = $google = $live = $douban = $renren = $kaixin = $xiaomi = 1;
		}
		echo '<p><label for="'.$this->get_field_id( 'title' ).'">'.__( 'Title:' ).'</label><input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'" /></p>';
		echo '<p><input id="'.$this->get_field_id('qq').'" name="'.$this->get_field_name('qq').'" type="checkbox" value="1" '.checked( '1', $qq, false).' /> <label for="'.$this->get_field_id('qq').'">'.$GLOBALS['open_str']['qq'].'</label> ';
		echo '<input id="'.$this->get_field_id('sina').'" name="'.$this->get_field_name('sina').'" type="checkbox" value="1" '.checked( '1', $sina, false).' /> <label for="'.$this->get_field_id('sina').'">'.$GLOBALS['open_str']['sina'].'</label> ';
		echo '<input id="'.$this->get_field_id('baidu').'" name="'.$this->get_field_name('baidu').'" type="checkbox" value="1" '.checked( '1', $baidu, false).' /> <label for="'.$this->get_field_id('baidu').'">'.$GLOBALS['open_str']['baidu'].'</label></p>';
		echo '<p><input id="'.$this->get_field_id('google').'" name="'.$this->get_field_name('google').'" type="checkbox" value="1" '.checked( '1', $google, false).' /> <label for="'.$this->get_field_id('google').'">'.$GLOBALS['open_str']['google'].'</label> ';
		echo '<input id="'.$this->get_field_id('live').'" name="'.$this->get_field_name('live').'" type="checkbox" value="1" '.checked( '1', $live, false).' /> <label for="'.$this->get_field_id('live').'">'.$GLOBALS['open_str']['live'].'</label> ';
		echo '<input id="'.$this->get_field_id('douban').'" name="'.$this->get_field_name('douban').'" type="checkbox" value="1" '.checked( '1', $douban, false).' /> <label for="'.$this->get_field_id('douban').'">'.$GLOBALS['open_str']['douban'].'</label></p>';
		echo '<p><input id="'.$this->get_field_id('renren').'" name="'.$this->get_field_name('renren').'" type="checkbox" value="1" '.checked( '1', $renren, false).' /> <label for="'.$this->get_field_id('renren').'">'.$GLOBALS['open_str']['renren'].'</label> ';
		echo '<input id="'.$this->get_field_id('kaixin').'" name="'.$this->get_field_name('kaixin').'" type="checkbox" value="1" '.checked( '1', $kaixin, false).' /> <label for="'.$this->get_field_id('kaixin').'">'.$GLOBALS['open_str']['kaixin'].'</label> ';
		echo '<input id="'.$this->get_field_id('xiaomi').'" name="'.$this->get_field_name('xiaomi').'" type="checkbox" value="1" '.checked( '1', $xiaomi, false).' /> <label for="'.$this->get_field_id('xiaomi').'">'.$GLOBALS['open_str']['xiaomi'].'</label></p>';
	}
	function update($new_instance, $old_instance) {
        $instance = $old_instance;
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['qq'] = strip_tags($new_instance['qq']);
        $instance['sina'] = strip_tags($new_instance['sina']);
        $instance['baidu'] = strip_tags($new_instance['baidu']);
        $instance['google'] = strip_tags($new_instance['google']);
        $instance['live'] = strip_tags($new_instance['live']);
        $instance['douban'] = strip_tags($new_instance['douban']);
        $instance['renren'] = strip_tags($new_instance['renren']);
        $instance['kaixin'] = strip_tags($new_instance['kaixin']);
        $instance['xiaomi'] = strip_tags($new_instance['xiaomi']);
        return $instance;
	}
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		if(!$title) $title = $GLOBALS['open_str']['widget_name'];
		$qq = $instance['qq'];
		$sina = $instance['sina'];
		$baidu = $instance['baidu'];
		$google = $instance['google'];
		$live = $instance['live'];
		$douban = $instance['douban'];
		$renren = $instance['renren'];
		$kaixin= $instance['kaixin'];
		$xiaomi= $instance['xiaomi'];
		echo $before_widget;
		if ( $title ) echo '<h3 class="widget-title">'.$title.'</h3>';
		echo '<div class="textwidget">';
		if(is_user_logged_in()){
			$current_user = wp_get_current_user();
			$m = $current_user->user_email;
			echo '<a href="'.(current_user_can('manage_options')?admin_url():get_edit_user_link($current_user->ID)).'">'.get_avatar($current_user->ID).'</a><br/>';
			if(strpos($m,'@t.qq.com')||strpos($m,'@weibo.com')||strpos($m,'@baidu.com')||strpos($m,'@douban.com')||strpos($m,'@renren.com')||strpos($m,'@kaixin.com')||strpos($m,'@xiaomi.com')) echo '<a href="'.get_edit_user_link($current_user->ID).'">'.$GLOBALS['open_str']['edit_fake_email'].'</a><br/>';
			echo '<a href="'.$current_user->user_url.'" target="_blank">'.$current_user->display_name.'</a>';
			echo ' (<a href="'.wp_logout_url($_SERVER['REQUEST_URI']).'">'.__('Log Out').'</a>)';
		}else{
			if(defined("QQ_AKEY") && QQ_AKEY && $qq) echo open_login_button_show('qq',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['qq'],$GLOBALS['open_str']['login']));
			if(defined("WB_AKEY") && WB_AKEY && $sina) echo open_login_button_show('sina',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['sina'],$GLOBALS['open_str']['login']));
			if(defined("BD_AKEY") && BD_AKEY && $baidu) echo open_login_button_show('baidu',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['baidu'],$GLOBALS['open_str']['login']));
			if(defined("GG_AKEY") && GG_AKEY && $google) echo open_login_button_show('google',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['google'],$GLOBALS['open_str']['login']));
			if(defined("WL_AKEY") && WL_AKEY && $live) echo open_login_button_show('live',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['live'],$GLOBALS['open_str']['login']));
			if(defined("DB_AKEY") && DB_AKEY && $douban) echo open_login_button_show('douban',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['douban'],$GLOBALS['open_str']['login']));
			if(defined("RR_AKEY") && RR_AKEY && $renren) echo open_login_button_show('renren',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['renren'],$GLOBALS['open_str']['login']));
			if(defined("KX_AKEY") && KX_AKEY && $kaixin) echo open_login_button_show('kaixin',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['kaixin'],$GLOBALS['open_str']['login']));
			if(defined("XM_AKEY") && XM_AKEY && $xiaomi) echo open_login_button_show('xiaomi',str_replace('%OPEN_TYPE%',$GLOBALS['open_str']['xiaomi'],$GLOBALS['open_str']['login']));
		}
		echo '</div>';
		echo $after_widget;
	}
}

class open_social_share_widget extends WP_Widget {
    function open_social_share_widget() {
        parent::WP_Widget(false, $name = $GLOBALS['open_str']['widget_share_title'], array( 'description' => $GLOBALS['open_str']['widget_share_desc'], ) );
    }
	function form($instance) {
		if($instance) {
			$title = $instance['title'];
			$weibo = esc_attr($instance['weibo']);
			$qzone = esc_attr($instance['qzone']);
			$qqt = esc_attr($instance['qqt']);
			$youdao = esc_attr($instance['youdao']);
			$email = esc_attr($instance['email']);
			$qq = esc_attr($instance['qq']);
			$weixin = esc_attr($instance['weixin']);
			$google = esc_attr($instance['google']);
			$twitter = esc_attr($instance['twitter']);
			$facebook = esc_attr($instance['facebook']);
			$switcher = esc_attr($instance['switcher']);
		} else {
			$title = '';
		    $weibo = $qzone = $qqt = $youdao = $email = $qq = $weixin = $google = $twitter = $facebook = $switcher = 1;
		}
		echo '<p><label for="'.$this->get_field_id( 'title' ).'">'.__( 'Title:' ).'</label><input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'" /></p>';
		echo '<p><input id="'.$this->get_field_id('weibo').'" name="'.$this->get_field_name('weibo').'" type="checkbox" value="1" '.checked( '1', $weibo, false).' /> <label for="'.$this->get_field_id('weibo').'">'.$GLOBALS['open_str']['share_weibo'].'</label> ';
		echo '<input id="'.$this->get_field_id('qzone').'" name="'.$this->get_field_name('qzone').'" type="checkbox" value="1" '.checked( '1', $qzone, false).' /> <label for="'.$this->get_field_id('qzone').'">'.$GLOBALS['open_str']['share_qzone'].'</label> ';
		echo '<input id="'.$this->get_field_id('qqt').'" name="'.$this->get_field_name('qqt').'" type="checkbox" value="1" '.checked( '1', $qqt, false).' /> <label for="'.$this->get_field_id('qqt').'">'.$GLOBALS['open_str']['share_qqt'].'</label> ';
		echo '<input id="'.$this->get_field_id('youdao').'" name="'.$this->get_field_name('youdao').'" type="checkbox" value="1" '.checked( '1', $youdao, false).' /> <label for="'.$this->get_field_id('youdao').'">'.$GLOBALS['open_str']['share_youdao'].'</label></p>';
		echo '<p><input id="'.$this->get_field_id('email').'" name="'.$this->get_field_name('email').'" type="checkbox" value="1" '.checked( '1', $email, false).' /> <label for="'.$this->get_field_id('email').'">'.$GLOBALS['open_str']['share_email'].'</label> ';
		echo '<input id="'.$this->get_field_id('qq').'" name="'.$this->get_field_name('qq').'" type="checkbox" value="1" '.checked( '1', $qq, false).' /> <label for="'.$this->get_field_id('qq').'">'.$GLOBALS['open_str']['share_qq'].'</label> ';
		echo '<input id="'.$this->get_field_id('weixin').'" name="'.$this->get_field_name('weixin').'" type="checkbox" value="1" '.checked( '1', $weixin, false).' /> <label for="'.$this->get_field_id('weixin').'">'.$GLOBALS['open_str']['share_weixin'].'</label> ';
		echo '<input id="'.$this->get_field_id('google').'" name="'.$this->get_field_name('google').'" type="checkbox" value="1" '.checked( '1', $google, false).' /> <label for="'.$this->get_field_id('google').'">'.$GLOBALS['open_str']['share_google'].'</label></p>';
		echo '<p><input id="'.$this->get_field_id('twitter').'" name="'.$this->get_field_name('twitter').'" type="checkbox" value="1" '.checked( '1', $twitter, false).' /> <label for="'.$this->get_field_id('twitter').'">'.$GLOBALS['open_str']['share_twitter'].'</label> ';
		echo '<input id="'.$this->get_field_id('facebook').'" name="'.$this->get_field_name('facebook').'" type="checkbox" value="1" '.checked( '1', $facebook, false).' /> <label for="'.$this->get_field_id('facebook').'">'.$GLOBALS['open_str']['share_facebook'].'</label> ';
		echo '<input id="'.$this->get_field_id('switcher').'" name="'.$this->get_field_name('switcher').'" type="checkbox" value="1" '.checked( '1', $switcher, false).' /> <label for="'.$this->get_field_id('switcher').'">'.$GLOBALS['open_str']['language_switch'].'</label></p>';
	}
	function update($new_instance, $old_instance) {
        $instance = $old_instance;
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['weibo'] = strip_tags($new_instance['weibo']);
        $instance['qzone'] = strip_tags($new_instance['qzone']);
        $instance['qqt'] = strip_tags($new_instance['qqt']);
        $instance['youdao'] = strip_tags($new_instance['youdao']);
        $instance['email'] = strip_tags($new_instance['email']);
        $instance['qq'] = strip_tags($new_instance['qq']);
        $instance['weixin'] = strip_tags($new_instance['weixin']);
        $instance['google'] = strip_tags($new_instance['google']);
        $instance['twitter'] = strip_tags($new_instance['twitter']);
        $instance['facebook'] = strip_tags($new_instance['facebook']);
        $instance['switcher'] = strip_tags($new_instance['switcher']);
        return $instance;
	}
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		if(!$title) $title = $GLOBALS['open_str']['widget_share_name'];
		$weibo = $instance['weibo'];
		$qzone = $instance['qzone'];
		$qqt = $instance['qqt'];
		$youdao = $instance['youdao'];
		$email = $instance['email'];
		$qq = $instance['qq'];
		$weixin = $instance['weixin'];
		$google = $instance['google'];
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$switcher = $instance['switcher'];
		$osop = get_option('osop');
		echo $before_widget;
		if ( $title ) echo '<h3 class="widget-title">'.$title.'</h3>';
		echo '<div class="textwidget">';
		if($weibo) echo open_share_button_show('weibo',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_weibo'],$GLOBALS['open_str']['share']),"http://v.t.sina.com.cn/share/share.php?url=%URL%&title=%TITLE%&appkey=".WB_AKEY."&ralateUid=".$osop['share_sina_user']."&language=zh_cn&searchPic=true");
		if($qzone) echo open_share_button_show('qzone',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_qzone'],$GLOBALS['open_str']['share']),"http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=%URL%&title=%TITLE%&desc=&summary=&site=");
		if($qqt) echo open_share_button_show('qqt',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_qqt'],$GLOBALS['open_str']['share']),"http://share.v.t.qq.com/index.php?c=share&amp;a=index&url=%URL%&title=%TITLE%&appkey=".$osop['share_qqt_appkey']);
		if($youdao) echo open_share_button_show('youdao',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_youdao'],$GLOBALS['open_str']['share']),"http://note.youdao.com/memory/?url=%URL%&title=%TITLE%&sumary=&pic=&product=");
		if($weixin) echo open_share_button_show('weixin',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_weixin'],$GLOBALS['open_str']['share']),"http://chart.apis.google.com/chart?chs=400x400&cht=qr&chld=L|5&chl=%URL%");
		if($email && $osop['share_qq_email']) echo open_share_button_show('email',$GLOBALS['open_str']['share_email'],"http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=".$osop['share_qq_email']);
		if($qq && $osop['share_qq_talk']) echo open_share_button_show('qq',$GLOBALS['open_str']['share_qq'],$osop['share_qq_talk']);
		if($google) echo open_share_button_show('google',$GLOBALS['open_str']['share_google'],"http://translate.google.com.hk/translate?hl=zh-CN&sl=en&tl=zh-CN&u=%URL%");
		if($twitter) echo open_share_button_show('twitter',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_twitter'],$GLOBALS['open_str']['share']),"http://twitter.com/home/?status=%TITLE%:%URL%");
		if($facebook) echo open_share_button_show('facebook',str_replace('%SHARE_TYPE%',$GLOBALS['open_str']['share_facebook'],$GLOBALS['open_str']['share']),"http://www.facebook.com/sharer.php?u=%URL%&amp;t=%TITLE%");
		if($switcher){
			if( get_locale() != 'en_US' ){
				echo open_tool_button_show('en','User Language: English',"?open_lang=en_US");
			}else if(WPLANG=='zh_CN'){
				echo open_tool_button_show('cn',$GLOBALS['open_str']['language_switch'].' '.WPLANG,"?open_lang=".WPLANG);
			}else if(WPLANG!=''){
				echo open_lang_button_show(WPLANG,$GLOBALS['open_str']['language_switch'].' '.WPLANG,"?open_lang=".WPLANG);			
			}else if(isset($_SESSION['WPLANG_LOCALE'])){
				echo open_lang_button_show($_SESSION['WPLANG_LOCALE'],$GLOBALS['open_str']['language_switch'].' '.$_SESSION['WPLANG_LOCALE'],"?open_lang=".$_SESSION['WPLANG_LOCALE']);			
			}
		}
		echo '</div>';
		echo $after_widget;
	}
}	

?>