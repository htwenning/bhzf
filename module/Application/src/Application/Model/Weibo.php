<?php

namespace Application\Model;

use Application\Model\OAuthException;
use Application\Model\SaeTClientV2;
use Application\Model\SaeTOAuthV2;

class Weibo {
	// 微博应用常量
	private static $WB_AKEY = '3303332652';
	private static $WB_SKEY = 'ad7fb0066c7979aa3ccc712665591e09';
	private static $WB_CALLBACK_URL = 'http://www.betweenhearts.org/libweibo/callback.php';
	private $o;
	public function __construct() {
		//
		session_start ();
		$this->$o = new SaeTOAuthV2 ( Weibo::$WB_AKEY, Weibo::$WB_SKEY );
		
		if (isset ( $_REQUEST ['code'] )) {
			$keys = array ();
			$keys ['code'] = $_REQUEST ['code'];
			$keys ['redirect_uri'] = Weibo::WB_CALLBACK_URL;
			try {
				$token = $o->getAccessToken ( 'code', $keys );
			} catch ( OAuthException $e ) {
			}
		}
		
		if ($token) { // 授权完成
			$_SESSION ['token'] = $token;
			setcookie ( 'weibojs_' . $o->client_id, http_build_query ( $token ) );
			// 更新用户信息
			$c = new SaeTClientV2 ( WB_AKEY, WB_SKEY, $_SESSION ['token'] ['access_token'] );
			$access_token = $_SESSION ['token'] ['access_token'];
			$ms = $c->home_timeline (); // done
			$uid_get = $c->get_uid ();
			$uid = $uid_get ['uid'];
			$user_message = $c->show_user_by_id ( $uid ); // 根据ID获取用户等基本信息
			                                            // $user = new User($user_message['screen_name'],$access_token);
			                                            // $username=$user->getValue("username");
			$username = $user_message ['screen_name'];
			// echo $username."<br>".$user->getValue("access_token")."<br>";
			// $user -> update();
			if ($username == "")
				$username = "微博用户";
			$_SESSION ['username'] = $username;
			echo $username;
			//跳转
			header ( "location: http://www.betweenhearts.org" );
		} else {
			echo "授权失败";
			session_destroy();
		}
	}
	public function sendMessage(){
		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
		if( isset($_REQUEST['text']) ) {
			$ret = $c->update( $_REQUEST['text'] );	//发送微博
			if ( isset($ret['error_code']) && $ret['error_code'] > 0 ) {
				echo "<p>发送失败，错误：{$ret['error_code']}:{$ret['error']}</p>";
			} else {
				echo "<p>发送成功</p>";
			}
		}
	}
}