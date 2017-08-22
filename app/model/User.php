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

	public function reg($username,$nickname,$password)
	{
		if($this->first('users',['username'=>$username])){
			$this->error='用户已存在';
			return false;
		}
		if($this->first('users',['nickname'=>$nickname])){
			$this->error='昵称已被使用';
			return false;
		}
		if($this->create('users',['username'=>$username,'nickname'=>$nickname,'password'=>$this->pmd($password),'reg_time'=>$_SERVER['REQUEST_TIME']])){
			return true;
		}else{
			$this->error='注册失败';
			return false;
		}

	}
}