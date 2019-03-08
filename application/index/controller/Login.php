<?php
namespace app\index\controller;

use think\Session;
use common\BaseController;
use app\index\model\User;

class Login extends BaseController
{
    protected $beforeActionList = [
    ];
    public function index()
    {
        if(request()->isPost()){
            $uname = input('post.username');
            $password = md5(input('post.password'));
            $user = User::getUserByNameAndPwd($uname, $password);
            if(count($user) > 0){
                Session::set('uid', $user[0]);
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
    public function register(){
        if(request()->isPost()){
            $uname = input('post.username');
            $password = md5(input('post.password'));
            $email = input('post.email');
            $alias = input('post.alias');
            $result = User::saveUser($uname,$password,$email,$alias);
            if($result){
                Session::set('uid', $result);
                $this->redirect('/');
            }
        }else{
            return view('register');
        }
    }
}
