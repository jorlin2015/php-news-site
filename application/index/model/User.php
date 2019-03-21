<?php
namespace app\index\model;

use think\Model;
use think\Db;
use util\DateUtil;
use app\index\model\Room;
use app\index\model\RoomUser;

class User extends Model{
	private const QUERYSQL = "select t.user_id, t.user_name, t.user_alias, t.user_img from t_user t where t.user_name=:name and t.user_pwd=:pwd";
	private const SAVESQL = "insert into t_user(user_name,user_alias,user_pwd,user_email,user_create_time) values(:name, :alias, :pwd, :email, :time)";

	public static function getUserByNameAndPwd($name, $pwd){
		$result = Db::query(self::QUERYSQL, ["name" => $name, "pwd" => $pwd]);
		return $result;
	}
	public static function saveUser($name, $pwd, $email, $alias){
		$time = DateUtil::getMillisecond();
		Db::execute(self::SAVESQL, ["name" => $name, "alias" => $alias, "pwd" => $pwd, "email" => $email, "time" => $time]);
		$user = self::getUserByNameAndPwd($name, $pwd);
		if(count($user) > 0){
			$uId = $user[0]["user_id"];
			$rId = Room::getDefaultRoom();
			RoomUser::addUserToRoom($rId,$uId);
		}
		return $user[0];
	}
}
?>