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

		$key    =get('key');

		$where=' WHERE 1=1';
		$bind=[];
		if($key!=''){
			$bind['key']=$key;
			$bind['keys']="%{$key}%";
			$where.=' AND (`id`=:key OR `nickname` LIKE :keys OR `username`=:key)';
		}

		$count=DB::query('SELECT count(*) FROM `:users` '.$where,$bind)->fetchColumn();

		$max=ceil($count/$config['pagenum']); //每页记录

		$start=($page-1)*$config['pagenum'];

		$sql=sprintf('SELECT * FROM `:users` %s ORDER BY `reg_time` DESC LIMIT %s,%s',$where,$start,$config['pagenum']);
		$list=DB::query($sql,$bind)->fetchAll();
		//var_dump($list);

		$this->assign('list',$list);
		$this->assign('search',[
			'key'=>$key,
		]);
		$this->assign('page',['curr'=>$page,'max'=>$max]);


		return $this->render();
	}
}