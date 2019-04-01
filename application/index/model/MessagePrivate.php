<?php
namespace app\index\model;

use think\Model;
use think\Db;
use util\DateUtil;

/**
 * 私聊信息模型
 */
class MessagePrivate extends Model{
	private const MESSAGESQL = "select m.pmsg_type type, m.pmsg_content content, m.pmsg_time time,u.user_id id, u.user_alias name, u.user_img img from t_message_private m, t_user u where m.pmsg_status = 1 and (m.pmsg_sender = :sender and m.pmsg_receiver = :receiver or m.pmsg_sender = :sender1 and m.pmsg_receiver = :receiver1) and m.pmsg_sender = u.user_id order by m.pmsg_time asc limit 100";
	private const MESSAGESQLCONT = "select count(m.pmsg_id) sum from t_message_private m, t_user u where m.pmsg_status = 1 and (m.pmsg_sender = :sender and m.pmsg_receiver = :receiver or m.pmsg_sender = :sender1 and m.pmsg_receiver = :receiver1) and m.pmsg_sender = u.user_id";
	private const MESSAGESQLPAGE = "select m.pmsg_type type, m.pmsg_content content, m.pmsg_time time,u.user_id id, u.user_alias name, u.user_img img from t_message_private m, t_user u where m.pmsg_status = 1 and (m.pmsg_sender = :sender and m.pmsg_receiver = :receiver or m.pmsg_sender = :sender1 and m.pmsg_receiver = :receiver1) and m.pmsg_sender = u.user_id order by m.pmsg_time asc limit :start,:size";
	private const SAVESQL = "insert into t_message_private(pmsg_type, pmsg_content, pmsg_time, pmsg_sender, pmsg_receiver) values(:type, :content, :time, :sender, :receiver)";
	public static function getMessage($sender, $receiver){
		return Db::query(self::MESSAGESQL, ["sender" => $sender, "receiver"=>$receiver, "sender1" => $receiver, "receiver1" => $sender]);
	}
	public static function getMessageCount($sender, $receiver){
		return Db::query(self::MESSAGESQLCONT, ["sender" => $sender, "receiver"=>$receiver, "sender1" => $receiver, "receiver1" => $sender])[0]['sum'];
	}
	public static function getMessagePage($sender, $receiver, $page, $size){
		$start = ($page - 1) * $size;
		return Db::query(self::MESSAGESQLPAGE, ["sender" => $sender, "receiver"=>$receiver, "sender1" => $receiver, "receiver1" => $sender, "start" => $start, "size" => $size]);
	}
	public static function saveTextMessage($sender, $receiver, $content){
		return self::saveMessage($sender, $receiver, $content,1);
	}
	private static function saveMessage($sender, $receiver, $content, $type){
		$time = DateUtil::getMillisecond();
		return Db::execute(self::SAVESQL, ["type" => $type, "content" => $content, "time" => $time, "sender" => $sender, "receiver" => $receiver]);
	}
}