<?php


namespace app\model;


use ke\Model;
use ke\Exception;

class Admin extends Model
{
    private $error='';

    private $info=[];

    private $site=[];
    
    /**
     * 取错误信息 如果有的话
     * @return errormsg
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * 取当前用户信息
     * @return userinfo
     */
    public function getInfo($key='')
    {
        if($key==''){
            return $this->info;
        }else{
            return $this->info[$key];
        }
    }

    /**
     * 取当前站点设置
     * @return siteconfig
     */
    public function getSiteInfo()
    {
        if($this->info['siteid']==='') throw new Exception('您的站点数据库存在错误,请联系管理员.');
        if(!empty($this->site)) return $this->site;
        $this->site=$this->first('site',['id'=>$this->info['siteid']]);
        return $this->site;
    }

    /**
     * 验证是否登录
     * @return info
     */
    public function checkLogin()
    {
        $token=session('AdminToken');
        if(empty($token)) return false;
        $this->info=$this->first('admin',['token'=>$token]);
        return $this->info;
    }


    /**
     * 登录
     * @param  string $usr 帐号
     * @param  string $pmd 密码
     * @return boolean     是否登录成功
     */
    public function login($usr,$pmd)
    {
        $d=$this->first('admin',['usr'=>$usr]);
        if(!$d){
            $this->error='寻找不到此帐号';
            return false;
        }
        if($d['pmd']!=md5(sha1($pmd))){
            $this->error='密钥不正确';
            return false;
        }
        $token=md5($usr.uniqid(session_id()));
        if($this->update('admin',['id'=>$d['id']],['login_time'=>$_SERVER['REQUEST_TIME'],'token'=>$token])){
            session('AdminToken',$token);
            return true;
        }else{
            $this->error='登录失败';
            return false;
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        session('AdminToken',null);
    }

}