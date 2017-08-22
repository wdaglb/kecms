<?php 
use ke\Route;

Route::group(['namespace'=>'index'],function(){
    Route::get('/',['as'=>'index','uses'=>'IndexController@index']);
    Route::any('/register',['as'=>'register','uses'=>'UserController@register']);
});

include APP_PATH.'./admin.php';