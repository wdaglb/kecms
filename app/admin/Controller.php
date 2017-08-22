<?php
/**
 * KECMS - 综合内容管理系统
 * http://cms.iydou.cn/
 */

namespace app\admin;


use ke\DB;
use ke\Exception;
use ke\Request;

class Controller extends \ke\Controller
{
    protected $fronts=['_ct','_checkLogin'];

    protected function _ct()
    {
        $ct=Request::get('module').'/'.Request::get('controller').'/'.Request::get('action');
        $this->assign('ct',$ct);

        $csrf_token=session('csrf_token');
        if(Request::isGet()){
            if(empty($csrf_token)){
                $csrf_token=md5(crypt(mt_rand(0,99999).uniqid(),'to'));
                session('csrf_token',$csrf_token);
            }
        }else{
            $form=post('_token_');
            if($form=='') throw new Exception('非法操作');
            if($form!=$csrf_token) throw new Exception('非法操作');
        }
        $this->assign('csrf_token',$csrf_token);
    }

    protected function _checkLogin()
    {
        $ct=Request::get('controller').'@'.Request::get('action');
        if(in_array($ct,['index@login','index@reset'])) return;
        $user=m('admin')->checkLogin();
        if(!$user){
            return $this->error('权限不足,请先登录系统',url('adminlogin'));
        }

        // 初始化站点配置
        if($user['useConfig']==0 || !DB::first('config',['id'=>$user['useConfig']])){
            $site=DB::query('SELECT id FROM `:config` ORDER BY `id` ASC')->fetchColumn();
            if(empty($site)){
                DB::create('config',['title'=>'默认站点']);
                DB::update('admin',['id'=>$user['id']],['useConfig'=>DB::getLastInsertId()]);
            }
        }
    }

}