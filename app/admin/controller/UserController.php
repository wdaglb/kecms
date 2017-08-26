<?php 
namespace app\admin\controller;

use ke\DB;
use ke\Request;
use app\admin\Controller;
use ke\Validate;

class UserController extends Controller
{
    // 列表
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

	// 编辑
    public function edit()
    {
        $id=get('id');
        if($id==''){
            return $this->aError('参数错误');
        }
        $data=DB::query('SELECT * FROM `:users` WHERE `id`=?',$id)->fetch();
        if(!$data){
            return $this->aError('此用户不存在或已被删除');
        }
        if(Request::isPost()){
            $form=post();
            $vali=new Validate([
                'username'=>'require|engint|max:20',
                'nickname'=>'require|max:20',
            ],[
                'username.require'=>'请输入用户帐号',
                'username.engint'=>'用户帐号只能为英文数字的组合',
                'username.max'=>'用户帐号应在20个字符内',
                'nickname.require'=>'请输入用户昵称',
                'nickname.max'=>'这个昵称太长了,应在20个字内',
            ]);
            if(!$vali->check($form)){
                return $this->aError($vali->getError());
            }
            $pmd=isset($form['password']) ? $form['password'] : '';
            $s=$vali->one($pmd,'engint|max:20',[
                'engint'=>'密码只能为英文与数字',
                'max'=>'密码最长为20个字符'
            ]);
            var_dump($s);
            var_dump($vali->getError());
            exit;

        }
        $this->assign('data',$data);
        return $this->render();
    }
}