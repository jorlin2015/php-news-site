<?php
namespace common;
use think\Session;
use think\Cookie;
use app\index\model\User;

/**
* 用户鉴权
*/
class Author
{
	public static function isLogin(){
		$flag = true;
		$user = Session::get('uid');
		if(empty($user)){
			$uname = Cookie::get('username');
			$password = Cookie::get('password');
			if(empty($uname) || empty($password)){
				$flag = false;
			}else{
				$user = User::getUserByNameAndPwd($uname, $password);
				if(empty($user)){
					$flag = false;
				}else{
					Session::set('uid', $user[0]);
				}
			}
		}
		return $flag;
	}
	public static function getUser(){
		return Session::get('uid');
	}
}