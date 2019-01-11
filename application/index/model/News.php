<?php
namespace app\index\model;
use think\Model;
use think\Db;

class News extends Model{
	protected $pk = 'id';
	public function getList($code, $index=0){
		$list = Db::table('t_news')
				->alias('n')
				->join('t_news_category l','n.id = l.news_id')
				->join('t_category c','c.id = l.category_id')
				->where('c.code', $code)
				->field('n.*')
				->limit($index,10)
				->select();
		return $list;
	}
	public function getCount($code){
		$list = Db::table('t_news')
				->alias('n')
				->join('t_news_category l','n.id = l.news_id')
				->join('t_category c','c.id = l.category_id')
				->where('c.code', $code)
				->field('count(n.id) sum')
				->select();
		return $list[0]['sum'];
	}
	public function getFavor($id, $label_ids){
		$list = Db::table('t_news')
				->alias('a')
				->join('t_news_category b','a.id = b.news_id')
				->join('t_category c','c.id = b.category_id')
				->join('t_news_label d','a.id = d.news_id')
				->join('t_label e','e.id = d.label_id')
				->where('a.id','<>', $id)
				->whereIn('e.id', $label_ids)
				->limit(10)
				->field('a.id,a.title,c.code')
				->select();
		return $list;
	}
	public function comments(){
		return $this->hasMany('Comment', 'news_id')->field('content');
	}
}
?>