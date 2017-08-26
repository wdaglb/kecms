<?php 
use ke\Route;

Route::group(['namespace'=>'index'],function(){
    Route::get('/',['as'=>'index','uses'=>'IndexController@index']);
    Route::any('/register',['as'=>'register','uses'=>'UserController@register']);
});

Route::group(['namespace'=>'admin'],function(){
    Route::get('/admin',['as'=>'admin','uses'=>'IndexController@index']);

    Route::any('/admin/login',['as'=>'adminlogin','uses'=>'IndexController@login']);
    // 重置管理帐号密码
    Route::any('/admin/reset',['as'=>'admin.reset','uses'=>'IndexController@reset']);
    // 登出系统
    Route::get('/admin/logout',['as'=>'admin.logout','uses'=>'IndexController@logout']);
    // 设置
    Route::any('/admin/setting',['as'=>'admin.setting','uses'=>'IndexController@setting']);

    // 会员
    Route::get('/admin/user',['as'=>'admin.user','uses'=>'UserController@lists']);
        // 编辑
        Route::any('/admin/user/edit',['as'=>'admin.user.edit','uses'=>'UserController@edit']);
});
