<?php 
namespace app\model;

use ke\Model;
class User extends Model
{
	private $error='';

	public function getError()
	{
		return $this->error;
	}

	public function pmd($str)
	{
		return md5(crypt($str,'ke'));
	}

	// 注册用户
	public function reg($username,$nickname,$password)
	{
		if($this->query('SELECT id FROM `:users` WHERE `delete`=0,`username`=?',$username)){
			$this->error='用户已存在';
			return 0;
		}
		if($this->query('SELECT id FROM `:users` WHERE `delete`=0,`nickname`=?',$nickname)){
			$this->error='昵称已被使用';
			return 0;
		}
		// 替换插入
		$update=['username'=>$username,'nickname'=>$nickname,'password'=>$this->pmd($password),'reg_time'=>$_SERVER['REQUEST_TIME']];
		$replaceId=$this->query('SELECT id FROM `:users` WHERE `delete`=1 ORDER BY `id` ASC LIMIT 1')->fetchColumn();
		if($replaceId){
			if($this->update('users',['id'=>$replaceId],$update)){
				return $replaceId;
			}else{
				$this->error='注册失败';
				return 0;
			}
		}
		if($this->create('users',$update)){
			return $this->getLastInsertId();
		}else{
			$this->error='注册失败';
			return 0;
		}
	}

	// 删除用户
	public function del($id)
	{
		return $this->update('users',['id'=>$id],['delete'=>1]);
	}
}