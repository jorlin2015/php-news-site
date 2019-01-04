<?php
namespace app\index\model;
use think\Model;

class Category extends Model{
	protected $pk = 'id';
	public function getList(){
		return $this->order('id', 'desc')
            ->select();
	}
}
?>