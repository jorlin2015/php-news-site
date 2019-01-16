<?php
namespace app\index\model;
use think\Model;
use think\Db;

class Label extends Model{
	protected $pk = 'id';
	public function news(){
		return $this->belongsToMany('News','NewsLabel');
	}
}
?>