<?php
/**
 * KECMS - 综合内容管理系统
 * http://cms.iydou.cn/
 */

namespace app\admin\controller;

use app\admin\Controller;
use ke\DB;
use ke\Request;
use ke\Validate;

class IndexController extends Controller
{
    // 后台主页
    public function index()
    {
        return $this->render();
    }

    // 登录页
    public function login()
    {
        //DB::create('admin',['usr'=>'root','pmd'=>md5(sha1('1')),'create_time'=>$_SERVER['REQUEST_TIME'],'name'=>'超级管理员']);
        if(Request::isPost()){
            $form=post();
            $vali=new Validate([
                'usr'=>'require|max:20',
                'pmd'=>'require|max:20'
            ],[
                'usr.require'=>'usr为管理帐号,请填写.',
                'usr.max'=>'管理帐号限制为20个字符',
                'pmd.require'=>'pmd为管理密钥,请填写.',
                'pmd.max'=>'管理密钥限制为20个字符'
            ]);
            if(!$vali->check($form)){
                return $this->json(1,$vali->getError());
            }
            if(m('admin')->login($form['usr'],$form['pmd'])){
                return $this->json(0,'登录成功',['url'=>url('admin')]);
            }else{
                return $this->json(1,m('admin')->getError());
            }
        }
        return $this->render();
    }

    // 重设密码
    public function reset()
    {
        $act=get('act',0);
        if($act==1){
            $file=CONF_PATH.'reset.json';
            if(!is_file($file)){
                return $this->error('reset.json文件不存在');
            }
            $data=json_decode(file_get_contents($file),true);
            $vali=new Validate([
                'usr'=>'require|max:20',
                'pmd'=>'require|max:20'
            ],[
                'usr.require'=>'usr为管理帐号,请填写.',
                'usr.max'=>'管理帐号限制为20个字符',
                'pmd.require'=>'pmd为管理密钥,请填写.',
                'pmd.max'=>'管理密钥限制为20个字符'
            ]);
            if(!$vali->check($data)){
                return $this->error($vali->getError());
            }
            DB::execute('TRUNCATE `:admin`');
            if(DB::create('admin',['usr'=>$data['usr'],'pmd'=>md5(sha1($data['pmd'])),'create_time'=>$_SERVER['REQUEST_TIME'],'name'=>'超级管理员'])){
                return $this->success('管理帐号密码重设成功',url('admin.reset'));
            }else{
                return $this->error('重设失败');
            }


        }
        return $this->render();
    }

}