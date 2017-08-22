<?php 
namespace app\admin\controller;

use ke\DB;
use ke\Request;
use app\admin\Controller;

class UserController extends Controller
{
	public function lists()
	{
		$config=config('admin');

		$page=get('page',1);
		$page=$page<1?1:$page;

		$bind=[];

		$status =get('status',0);
		$key    =get('key');
		$you    =get('you',0);

		$where=' WHERE 1=1';

		$count=DB::count('users');

		$max=ceil($count/$config['pagenum']); //每页记录

		$start=($page-1)*$config['pagenum'];

		$list=DB::all('users');
		//var_dump($list);

		$this->assign('list',$list);
		$this->assign('search',[
			'key'=>$key,
			'status'=>$status,
			'you'=>$you
		]);
		$this->assign('page',['curr'=>$page,'max'=>$max]);


		return $this->render();
	}
}