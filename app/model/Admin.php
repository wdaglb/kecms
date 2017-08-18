<?php


namespace app\model;


use ke\Model;

class Admin extends Model
{
    private $error='';
    public function getError()
    {
        return $this->error;
    }
    public function checkLogin()
    {
        $token=session('AdminToken');
        if(empty($token)) return false;
        $d=$this->first('admin',['token'=>$token]);
        return $d;
    }

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

}