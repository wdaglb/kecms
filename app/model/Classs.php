<?php 
namespace app\model;

use ke\Model;

class Classs extends Model
{
	public $list=[];
	public function getNode($data,$classid=0,$list=[])
	{
		foreach ($data as $k=>$item) {
			if($item['classid']==$classid){
				$item['sub']=$this->query('SELECT id,classid,title,px FROM `:class` WHERE `classid`=?',$item['id'])->fetchAll();
				$this->list[$item['id']]=$item;
				$this->getNode($data,$item['id'],$list);

			}
		}
		return $list;


	}
}