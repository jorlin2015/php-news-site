<?php
namespace app\index\model;

use think\Model;
use think\Db;
use util\DateUtil;

/**
 * 好友模型
 */
class Friend extends Model
{
	private const QUERYCONTACTBYUSER = "select u.user_id id,u.user_alias name, 2 type from t_user u, t_friend f where u.user_status=1 and f.rfriend_user=:uid and f.rfriend_status=1 and u.user_id=f.rfriend_friend";
	private const TOBEFRIENDSQL = "insert into t_friend(rfriend_user,rfriend_friend,rfriend_time) values(:uid,:fid,:time)";
	public static function getFriendByUser($uid){
		return Db::query(self::QUERYCONTACTBYUSER, ["uid" => $uid]);
	}
	public static function toBeFriend($uid,$fid){
		$time = DateUtil::getMillisecond();
		$arr = [
			str_replace(":time", $time,str_replace(":fid", $fid,str_replace(":uid", $uid,self::TOBEFRIENDSQL))),
			str_replace(":time", $time,str_replace(":fid", $uid,str_replace(":uid", $fid,self::TOBEFRIENDSQL)))
		];
		return Db::batchQuery($arr);
		/*return Db::execute(self::TOBEFRIENDSQL, ["uid" => $uid, "fid" => $fid, "time" => $time]);*/
	}
}