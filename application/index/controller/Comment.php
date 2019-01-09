<?php
namespace app\index\controller;

use app\index\model\Comment;
use think\Controller;
use common\Author;

class Comment extends Controller
{
    public function index($current='xinwen'){
        $news = new News();
        $list = $news->getList($current);
        $count = $news->getCount($current);
        return view('index', [
            'category' => $this->category,
            'list' => $list,
            'current' => $current,
            'hasMore' => $count > 10,
            'isLogin' => Author::isLogin()
        ]);
    }
}
