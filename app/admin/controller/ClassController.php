<?php 
namespace app\admin\controller;

use ke\DB;
use ke\Request;
use ke\Validate;
use app\admin\Controller;

class ClassController extends Controller
{

	public function _init()
	{
		$this->assign('module_list',m('module')->getList());
	}
	// 列表
	public function lists()
	{

		return $this->render();
	}

	public function ajaxList()
	{
		$id=get('id',0);
		$first=get('first',0);
		// 获取栏目信息
		if($first==1){
			$data=DB::query('SELECT a.* FROM `:class` a WHERE `id`=? ',$id)->fetch();
			return $this->json(0,'',['data'=>$data]);
		}

		// 获取栏目列表
		$list=DB::query('SELECT a.*,(SELECT id FROM `:class` WHERE classid=a.id) sub FROM `:class` a WHERE `classid`=? GROUP BY a.id ORDER BY `px` ASC,`create_time` DESC',$id)->fetchAll();

		return $this->json(0,'',['list'=>$list]);
	}

	// 添加
	public function add()
	{
		if(Request::isPost()){
			$form=post();
			$vali=new Validate([
				'title'=>'require|max:20',
				'module'=>'require|engint'
			],[
				'title.require'=>'请填写栏目标题',
				'title.max'=>'栏目标题应小于20个字符',
				'module'=>'非法的模块'
			]);
			if(!$vali->check($form)){
				return $this->aError($vali->getError());
			}
			// 序列字符
			def($form,['name','keywords','description','pass','user']);
			// 序列数值
			def($form,['classid','px','money','status'],1);
			if($form['name']!=''){
				if(DB::query('SELECT id FROM `:class` WHERE `name`=?',$form['name'])->fetch()){
					return $this->aError('Name已存在,此值必须唯一.');
				}
			}

			if(DB::create('class',[
				'title'=>$form['title'],
				'name'=>$form['name'],
				'classid'=>$form['classid'],
				'module'=>$form['module'],
				'content'=>$form['content'],
				'px'=>$form['px'],
				'create_time'=>$_SERVER['REQUEST_TIME'],
				'status'=>$form['status'],
				'keywords'=>$form['keywords'],
				'description'=>$form['description'],
				'money'=>$form['money'],
				'pass'=>$form['pass'],
				'user'=>$form['user']
				])){
				return $this->aSuccess('栏目已添加成功','admin.class');
			}else{
				return $this->aError('添加失败');
			}


		}

		// 获取所有栏目并排列多级select
		//$classlist=[];
		//$list=DB::query('SELECT id,classid,title,px FROM `:class` WHERE `classid`=0 ORDER BY `px` ASC')->fetchAll();
		//$classlist=m('classs')->getNode($list);
		//	var_dump($classlist);
		//	exit;
		$classid=get('id',0);
		if($classid==0){
			$class=['id'=>0,'name'=>'首页'];
		}else{
			$class=DB::query('SELECT id,title name FROM `:class` WHERE `id`=?',$classid)->fetch();
		}

		$this->assign('class',$class);

		return $this->render('form');

	}


}