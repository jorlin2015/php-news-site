<?php
namespace common;
use think\Session;

/**
* 用户鉴权
*/
class Author
{
	public static function isLogin(){
		return !empty(Session::get('uid'));
	}
	public static function getUser(){
		return Session::get('uid');
	}
}