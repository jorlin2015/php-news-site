<?php
namespace app\index\controller;

use common\BaseController;
use common\Author;
use app\index\model\User;
use app\index\model\MessageRoom;
use app\index\model\MessagePrivate;

class History extends BaseController
{
    public function index()
    {
        $user = Author::getUser();
        $type = input('get.type');
        $id = input('get.id');
        $params = [
            "user" => $user,
            "type" => $type,
            "id" => $id
        ];
        return view('History', $params);
    }
    public function getMessage(){
        $type = input('get.type');
        $id = input('get.id');
        $page = input('get.page');
        $size = input('get.size');
        switch ($type) {
            case '1'://房间
                $count = $this->getCountFromRoom($id);
                $list = $this->getMessageFromRoom($id, $page, $size);
                break;
            case '2'://好友
                $count = $this->getCountFromFriend($id);
                $list = $this->getMessageFromFriend($id, $page, $size);
                break;
        }
        $result = [
            "current_page" => (int)$page,
            "page_size" => (int)$size,
            "totalCount" => $count,
            "list" => $list
        ];
        return json($result);
    }
    private function getCountFromRoom($id){
        return MessageRoom::getMessageCount($id);
    }
    private function getCountFromFriend($id){
        $uid = (Author::getUser())["user_id"];
        return MessagePrivate::getMessageCount($id, $uid);
    }
    private function getMessageFromRoom($id, $page, $size){
        return MessageRoom::getMessagePage($id, $page, $size);
    }
    private function getMessageFromFriend($id, $page, $size){
        $uid = (Author::getUser())["user_id"];
        return MessagePrivate::getMessagePage($id, $uid, $page, $size);
    }
}