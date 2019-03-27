<?php
namespace app\index\model;

use think\Model;
use think\Db;
use util\DateUtil;

/**
 * 聊天室信息模型
 */
class MessageRoom extends Model{
	private const MESSAGESQL = "select m.rmsg_type type, m.rmsg_content content, m.rmsg_time time, u.user_id id, u.user_alias name, u.user_img img from t_message_room m, t_user u where m.rmsg_room = :id and m.rmsg_status = 1 and m.rmsg_sender=u.user_id order by m.rmsg_time asc limit 100";
	private const MESSAGESQLPAGE = "select m.rmsg_type type, m.rmsg_content content, m.rmsg_time time, u.user_id id, u.user_alias name, u.user_img img from t_message_room m, t_user u where m.rmsg_room = :id and m.rmsg_status = 1 and m.rmsg_sender=u.user_id order by m.rmsg_time asc limit :start,:end";
	private const SAVESQL = "insert into t_message_room(rmsg_type, rmsg_content, rmsg_time, rmsg_sender, rmsg_room) values(:type, :content, :time, :sender, :room)";
	public static function getMessage($room){
		return Db::query(self::MESSAGESQL, ["id" => $room]);
	}
	public static function getMessagePage($room, $page, $size){
		$start = ($page - 1) * $size;
		$end =  $start + $size - 1;
		return Db::query(self::MESSAGESQLPAGE, ["id" => $room, "start" => $start, "end" => $end]);
	}
	public static function saveTextMessage($room, $sender, $content){
		return self::saveMessage($room, $sender, $content,1);
	}
	private static function saveMessage($room, $sender, $content, $type){
		$time = DateUtil::getMillisecond();
		return Db::execute(self::SAVESQL, ["type" => $type, "content" => $content, "time" => $time, "sender" => $sender, "room" => $room]);
	}
}