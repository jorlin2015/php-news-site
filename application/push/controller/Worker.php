<?php

namespace app\push\controller;

use think\worker\Server;
use app\index\model\MessageRoom;
use app\index\model\MessagePrivate;

class Worker extends Server
{
    protected $socket = 'websocket://172.16.22.2:2346';
    protected $processes = 1;
    private $_name = [];
    protected $connections = [
        "room" => [],
        "friend" => []
    ];
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        $arr = json_decode($data,true);
        $this->handMessage($arr,$connection);
    }
    private function saveRoomMessage($data){
        try {
            MessageRoom::saveTextMessage($data['to'], $data['from'], $data['content']);
        } catch (Exception $e) {
            var_dump('--------------------------------------');
        }
    }
    private function savePrivateMessage($data){
        MessagePrivate::saveTextMessage($data['from'], $data['to'],  $data['content']);
    }
    private function handMessage($data,$connection){
        switch ($data['action']) {
            case 'message':
                $type = $data['type'];
                $data['name'] = $this->getName($connection->id);
                if($type == 1){//聊天室
                    $roomId = $data['to'];
                    $this->saveRoomMessage($data);
                    $this->sendRoomMessage($data, $roomId);
                }else if($type == 2){//私聊
                    $this->sendPrivateMessage($data);
                    $this->savePrivateMessage($data);
                }
                break;
            case 'contacts':
                $this->setName($connection->id,$data['name']);
                $this->connections['friend'][$data['from']] = $connection;
                foreach ($data['list'] as $key => $value) {
                    $type = $value['type'];
                    if($type == 1){//聊天室
                        $roomId = $value['id'];
                        $roomConnections = $this->connections['room'];
                        if(!(isset($roomConnections[$roomId]))){
                            $this->connections['room'][$roomId] = [];
                        }
                        $this->connections['room'][$roomId][$data['from']] = $connection;
                    }
                }
                break;
            default:
                # code...
                break;
        }
    }
    private function sendPrivateMessage($msg){
        $conns = $this->connections['friend'];
        if(isset($conns[$msg['to']])){
            $content = json_encode($msg);
            $conns[$msg['to']]->send($content);
        }
    }
    private function sendRoomMessage($msg, $id){
        $conns = $this->connections['room'][$id];
        $uId = $msg['from'];
        $content = json_encode($msg);
        foreach ($conns as $key => $value) {
            if($key != $uId){
                $value->send($content);
            }
        }
    }
    private function setName($id, $name){
        $this->_name[$id] = $name;
    }
    private function getName($id){
        return $this->_name[$id];
    }
    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {
    	// $this->setName($connection->id,'匿名'.rand(1000,9999));
    }

    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {
        var_dump('close==================');
    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {

    }
}