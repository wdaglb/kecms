<?php 
namespace app\index\controller;

use ke\Request;
use ke\Validate;
use app\index\Controller;

class UserController extends Controller
{
	public function register()
	{
		if(Request::isPost()){
			$form=post();
			$vali=new Validate([
				'username'=>'require|max:20|engint',
				'nickname'=>'require|max:20',
				'password'=>'require|max:20'
			],[
				'username.require'=>'请输入帐号',
				'username.max'=>'用户帐号最多支持20个字符',
				'username.engint'=>'用户帐号只能为英文数字组合',
				'nickname.require'=>'请输入昵称',
				'nickname.max'=>'昵称最多支持20个字符',
				'password.require'=>'请输入密码',
				'password.max'=>'用户密码最多支持20个字符'
			]);
			if(!$vali->check($form)){
				return $this->error($vali->getError());
			}
			if(m('user')->reg($form['username'],$form['nickname'],$form['password'])){
				return $this->success('用户注册成功','login');
			}else{
				return $this->error(m('user')->getError());
			}

		}
		return $this->render();
	}

}