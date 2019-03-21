<?php
namespace common;

use think\Controller;
use common\Author;

/**
 * 公共控制器
 */
class BaseController extends Controller
{
	protected $beforeActionList = [
        'first'
    ];
    protected function first(){
        if(!Author::isLogin()){
            $this->redirect('/login');
        }
    }
}