<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
include_once '../db/config.php';
include_once( '../db/User.php' );


$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
	} catch (OAuthException $e) {
	}
}

if ($token) {
	$_SESSION['token'] = $token;
	setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
?>
授权完成,<!--<a href="weibolist.php">进入你的微博列表页面</a><br />-->

<?php
//更新用户信息
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$access_token = $_SESSION['token']['access_token'];
$ms  = $c->home_timeline(); // done
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
//$user = new User($user_message['screen_name'],$access_token);
//$username=$user->getValue("username");
$username=$user_message['screen_name'];
//echo $username."<br>".$user->getValue("access_token")."<br>";
//$user -> update();
if($username=="") $username="微博用户";
 $_SESSION['username']=$username;
 echo $username;
header("location: http://www.betweenhearts.org");
} else {
?>
授权失败。
<?php
session_destroy();
}
?>
