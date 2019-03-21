<?php
namespace app\index\controller;

use common\BaseController;
use common\Author;
use app\index\model\User;
use app\index\model\RoomUser;
use app\index\model\Friend;
use app\index\model\MessageRoom;
use app\index\model\MessagePrivate;

class Index extends BaseController
{
    public function index()
    {
        $user = Author::getUser();
        $uid = $user["user_id"];
        $params = [
            "user" => $user
        ];
        return view('index', $params);
    }
    /**
     *根据房间id获取房间成员
     */
    public function getRoomMember(){
        $id = input('get.id');
        $result = RoomUser::getUserByRoom($id);
        return json($result);
    }
    public function getMessage(){
        $type = input('get.type');
        $id = input('get.id');
    	switch ($type) {
            case '1'://房间
                $result = $this->getMessageFromRoom($id);
                break;
            case '2'://好友
                $result = $this->getMessageFromFriend($id);
                break;
        }
    	return json($result);
    }
    public function getContacts(){
        $user = Author::getUser();
        $uid = $user["user_id"];
        $rooms = RoomUser::getRoomByUser($uid);
        $friends = Friend::getFriendByUser($uid);
        return json(array_merge($rooms,$friends));
    }
    public function toBeFriend(){
        $id = input('post.id');
        $user = Author::getUser();
        $uid = $user["user_id"];
        return json(['result' => Friend::toBeFriend($uid, $id)]);
    }
    private function getMessageFromRoom($id){
        return MessageRoom::getMessage($id);     
    }
    private function getMessageFromFriend($id){
        $uid = (Author::getUser())["user_id"];
        return MessagePrivate::getMessage($id, $uid);
    }
}