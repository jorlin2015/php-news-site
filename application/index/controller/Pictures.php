<?php
namespace app\index\controller;

use think\Controller;
use splider\Splider;

class Pictures extends Controller
{
    public function index($name='自然田园风光', $limit=30, $start=0)
    {
        $data = Splider::getBaiduImg($name,$limit,$start);
        $data['keyword'] = $name;
        return view('splider',$data);
    }
}