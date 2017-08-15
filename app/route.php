<?php 
use ke\Route;

Route::get('/',['as'=>'index','uses'=>'IndexController@index']);

include APP_PATH.'./admin.php';