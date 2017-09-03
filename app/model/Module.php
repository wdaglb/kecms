<?php 
namespace app\model;

use ke\Model;

class Module extends Model
{
	/**
	 * 获取模块列表
	 * @param  integer $status
	 * @return datalist        
	 */
	public function getList($status=0)
	{
		return $this->query('SELECT * FROM `:module` WHERE `status`='.intval($status).' ORDER BY convert(title using gbk) ASC');
	}
}