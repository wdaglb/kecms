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
                'usr.require'=>'请填写管理帐号.',
                'usr.max'=>'管理帐号限制为20个字符',
                'pmd.require'=>'请填写管理密钥.',
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

    // 登出系统
    public function logout()
    {
        m('admin')->logout();
        return $this->success('您已成功退出系统','admin.login');

    }

    // 站点设置
    public function setting()
    {
        if(Request::isPost()){
            $form=post();
            $vali=new Validate([
                'title'=>'require|max:50',
                'icp'=>'max:20',
                'seo_keywords'=>'max:255',
                'seo_description'=>'max:255'
            ],[
                'title.require'=>'请输入站点名称',
                'title.max'=>'站点名称应在50个字符内',
                'icp'=>'备案号应在20个字符内',
                'seo_keywords'=>'SEO关键词应在255个字符内',
                'seo_description'=>'SEO描述应在255个字符内',
            ]);
            if(!$vali->check($form)){
                return $this->json(1,$vali->getError());
            }
            $user=m('admin')->getInfo('siteid');
            if(!DB::first('site',['id'=>$user])){
                return $this->json(1,"你的站点数据库存在错误[{$user}]");
            }
            if(DB::update('site',['id'=>$user],[
                'title'=>$form['title'],
                'status'=>isset($form['status']) ? $form['status'] : 0,
                'reg'=>isset($form['reg']) ? $form['reg'] : 0,
                'icp'=>isset($form['icp']) ? $form['icp'] : '',
                'keywords'=>isset($form['seo_keywords']) ? $form['seo_keywords'] : '',
                'description'=>isset($form['seo_description']) ? $form['seo_description'] : '',
            ])){
                return $this->json(0,'站点信息更新成功');
            }else{
                return $this->json(1,'信息更新失败');
            }
        }
        $siteinfo=m('admin')->getSiteInfo();
        $this->assign('site',$siteinfo);
        return $this->render();
    }

    // 域名绑定
    public function domain()
    {
        $siteid=m('admin')->getInfo('siteid');
        $list=DB::all('domain',['siteid'=>$siteid]);
        $this->assign('list',$list);
        return $this->render();
    }
    public function domainBind()
    {
        $form=post('domain');
        if($form=='') return $this->json(1,'请输入需要绑定的域名');
        // 检测是否合格域名
        if(!preg_match('/[a-z]+\.[a-z]+/',$form)){
            return $this->json(1,'请输入正确的域名');
        }

        $siteid=m('admin')->getInfo('siteid');
        if(!DB::first('site',['id'=>$siteid])){
            return $this->json(1,"站点不存在或已被删除[{$siteid}]");
        }
        if(DB::first('domain',['src'=>$form])){
            return $this->json(1,'该域名已经被绑定了,请先解绑该域名.');
        }
        if(DB::create('domain',['siteid'=>$siteid,'src'=>$form,'create_time'=>$_SERVER['REQUEST_TIME']])){
            return $this->json(0,'域名绑定成功');
        }else{
            return $this->json(1,'域名绑定失败');
        }


    }

}