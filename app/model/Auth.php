<?php 
namespace app\model;

use ke\Model;

class Auth extends Model
{
	public function checkLogin()
	{
		$token=session('UserToken');
		if(empty($token)){
		    return false;
		}


	}

	public function getInfo()
	{
		$openid=session('user_openid');
		$user=$this->query('SELECT * FROM `:users` WHERE `openid`=?',$openid)->fetch();
		return $user;
	}
}