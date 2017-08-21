<?php
/**
 * KECMS - 综合内容管理系统
 * http://cms.iydou.cn/
 */
use ke\Route;
Route::group(['namespace'=>'admin'],function(){
    Route::get('/admin',['as'=>'admin','uses'=>'IndexController@index']);

    Route::any('/admin/login',['as'=>'adminlogin','uses'=>'IndexController@login']);
    // 重置管理帐号密码
    Route::any('/admin/reset',['as'=>'admin.reset','uses'=>'IndexController@reset']);
    // 登出系统
    Route::any('/admin/logout',['as'=>'admin.logout','uses'=>'IndexController@logout']);
    // 设置
    Route::any('/admin/setting',['as'=>'admin.setting','uses'=>'IndexController@setting']);
    // 绑定域名
    Route::get('/admin/bindDomain',['as'=>'admin.domain','uses'=>'IndexController@domain']);
    	// 绑定域名
    	Route::any('/admin/bindDomain.post',['as'=>'admin.domain.bind','uses'=>'IndexController@domainBind']);
});
