<?php
namespace app\index\controller;

use think\Controller;
use think\Session;
use app\index\model\User;

class Login extends Controller
{
    public function index()
    {
        if(request()->isPost()){
            $uname = input('post.username');
            $password = md5(input('post.password'));
            $user = User::get(['name' => $uname, 'password' => $password]);
            if($user){
                Session::set('uid', $user);
                $this->redirect('/');
            }else{
                return view('login',['msg' => '用户名密码错误']);
            }
        }else{
            return view('login');
        }
    }
    public function out(){
        Session::clear();
        $this->redirect('/');
    }
}
