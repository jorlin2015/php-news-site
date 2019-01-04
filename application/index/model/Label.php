<?php
namespace app\index\model;
use think\Model;
use think\Db;

class Label extends Model{
	protected $pk = 'id';
	public function getList($id){
		$list = Db::table('t_label')
				->alias('a')
				->join('t_news_label b','a.id = b.label_id')
				->where('b.news_id', $id)
				->field('a.id,a.name')
				->select();
		return $list;
	}
}
?>