<?php
namespace app\index\model;

use think\Model;
use think\Db;
use util\DateUtil;

/**
 * 聊天室模型
 */
class Room extends Model
{
	private const DEFAULTQUERYSQL = "select t.room_id from t_room t where t.room_id = :id";
	private const DEFAULTINSERTSQL = "insert into t_room(room_id, room_name, room_create_time) values(1, '公共聊天室', :time)";
	/**
	 *获取默认房间，没有则创建
	 *返回值，默认房间ID
	 */
	public static function getDefaultRoom(){
		$dRoom = Db::query(self::DEFAULTQUERYSQL, ["id" => 1]);
		if(count($dRoom) == 0){
			$time = DateUtil::getMillisecond();
			Db::execute(self::DEFAULTINSERTSQL,["time" => $time]);
		}
		return 1;
	}
}