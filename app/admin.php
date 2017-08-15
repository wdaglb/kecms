<?php
/**
 * KECMS - 综合内容管理系统
 * http://cms.iydou.cn/
 */
use ke\Route;
Route::group(['namespace'=>'admin'],function(){
    Route::get('/admin',['as'=>'index','uses'=>'IndexController@index']);
});
