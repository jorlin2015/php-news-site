<?php
namespace app\index\model;

use think\Model;
use think\Db;
use util\DateUtil;

/**
 * 聊天室用户模型
 */
class RoomUser extends Model
{
	private const SAVESQL = "insert into t_room_user(ruser_room, ruser_user, ruser_enter_time) values(:room, :user, :time)";
	private const QUERYROOMBYUSER = "select r.room_id id,r.room_name name, 1 type from t_room r, t_room_user ru where r.room_status=1 and ru.ruser_status=1 and ru.ruser_id=:uid and r.room_id=ru.ruser_room";
	private const QUERYUSERBYROOM = "select u.user_id id,u.user_alias name from t_room_user ru, t_user u where ru.ruser_status=1 and u.user_status=1 and ru.ruser_room=:rid and u.user_id=ru.ruser_user";
	public static function addUserToRoom($room,$user){
		$time = DateUtil::getMillisecond();
		return Db::execute(self::SAVESQL, ["room" => $room, "user" => $user, "time" => $time]);
	}
	public static function getRoomByUser($uid){
		return Db::query(self::QUERYROOMBYUSER, ["uid" => $uid]);
	}
	public static function getUserByRoom($rid){
		return Db::query(self::QUERYUSERBYROOM, ["rid" => $rid]);
	}
}