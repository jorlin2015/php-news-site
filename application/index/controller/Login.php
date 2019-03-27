<?php
namespace app\index\controller;

use think\Session;
use think\Cookie;
use common\BaseController;
use common\Author;
use app\index\model\User;

class Login extends BaseController
{
    protected $beforeActionList = [
        'second' => ['only' => 'index']
    ];
    protected function second(){
        if(Author::isLogin()){
            $this->redirect('/');
        }
    }
    public function index()
    {
        if(request()->isPost()){
            $uname = input('post.username');
            $password = md5(input('post.password'));
            $remember = input('post.remember');
            $user = User::getUserByNameAndPwd($uname, $password);
            if(count($user) > 0){
                Session::set('uid', $user[0]);
                if(!empty($remember)){
                    Cookie::set('username',$uname,3600*5);
                    Cookie::set('password',$password,3600*5);
                }
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
        Cookie::delete('usnername');
        Cookie::delete('password');
        $this->redirect('/');
    }
    public function register(){
        if(request()->isPost()){
            $uname = input('post.username');
            if(count(User::getUserByName($uname)) > 0){
                return view('register', ['msg' => '该账号已存在']);
            }
            $password = md5(input('post.password'));
            $password2 = md5(input('post.confirmPassword'));
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
