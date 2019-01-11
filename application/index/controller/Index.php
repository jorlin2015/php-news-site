<?php
namespace app\index\controller;

use app\index\model\Category;
use app\index\model\News;
use app\index\model\Label;
use app\index\model\Comment;
use think\Controller;
use common\Author;

class Index extends Controller
{
    protected $beforeActionList = [
        // 'first',
        'getCategory' => ['except'=>'more']
    ];
    public function first(){
        if(!Author::isLogin()){
            $this->redirect('/login');
        }
    }
    public function getCategory(){
        if(!isset($this->category)){
            $this->category = (new Category())->getList();
        }
    }
    public function index($current='xinwen')
    {
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
    public function detail($current, $id){
        $news = new News();
        $detail = $news->get($id);
        // $comments = Comment::all(['news_id'=>$id]);
        $comments = $detail->comments;
        $label = new Label();
        $labels = $label->getList($id);
        $param = [
            'category' => $this->category,
            'current' => $current,
            'detail' => $detail,
            'labels' => $labels,
            'comments' => $comments,
            'isLogin' => Author::isLogin()
        ];
        if($param['isLogin']){
            $temps = [];
            foreach ($labels as $l) {
                array_push($temps, $l['id']);
            }
            $favors = $news->getFavor($id,$temps);
            $param['favors'] = $favors;
            $param['user'] = Author::getUser();
        }
        return view('detail', $param);
    }
    public function more($current){
        $news = new News();
        $index = input('index');
        $list = $news->getList($current, $index);
        $count = $news->getCount($current);
        return view('more', [
            'list' => $list,
            'index' => $index + 10,
            'hasMore' => $count > $index + 10,
            'current' => $current
        ]);
    }
}
