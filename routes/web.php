<?php

// use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/','WebController@index');

Route::group(['prefix' => 'index'], function(){
    Route::get('/','WebController@index');

    Route::post('/login','WebController@login');
    Route::get('/verifycode','WebController@verifycode');
    Route::get('/logout','WebController@logout');
    Route::get('/register','WebController@register');
    Route::post('/validating','WebController@validating');
    Route::get('/forgetpwd','WebController@forgetpwd');
    Route::post('/updatepwd','WebController@updatepwd');

    Route::post('/book','WebController@book');
    Route::get('/book2','WebController@book2');

    Route::get('/cancel','WebController@cancel');
    Route::post('/order','WebController@order');
    Route::get('/order2','WebController@order2');

    Route::post('/comment','WebController@comment');

    Route::get('/search','WebController@search');
    Route::post('/search2','WebController@search2');
    Route::get('/search3','WebController@search3');
    
    Route::get('/del_order/{kn}','WebController@del_order');
    Route::get('/edit_order/{kn}','WebController@edit_order');
    Route::post('/edit_up','WebController@edit_up');
    
});

Route::group(['prefix' => 'manage'], function(){
    Route::get('/','ManageController@manage');
    Route::get('/verifycode','WebController@verifycode');

    Route::post('/login','ManageController@login');
    Route::get('/logout','ManageController@logout');

    Route::get('/userinfo','ManageController@userinfo');
    Route::get('/userinfo_add','ManageController@userinfo_add');
    Route::post('/userinfo_add2','ManageController@userinfo_add2');
    Route::get('/userinfo_edit/{kn}','ManageController@userinfo_edit');
    Route::post('/userinfo_update','ManageController@userinfo_update');
    Route::get('/userinfo_del/{kn}','ManageController@userinfo_del');

    Route::get('/orderinfo','ManageController@orderinfo');
    Route::get('/orderinfo_add','ManageController@orderinfo_add');
    Route::post('/orderinfo_add2','ManageController@orderinfo_add2');
    Route::get('/orderinfo_edit/{kn}','ManageController@orderinfo_edit');
    Route::post('/orderinfo_update','ManageController@orderinfo_update');
    Route::get('/orderinfo_del/{kn}','ManageController@orderinfo_del');

    Route::get('/chatinfo','ManageController@chatinfo');
    Route::get('/chatinfo_add','ManageController@chatinfo_add');
    Route::post('/chatinfo_add2','ManageController@chatinfo_add2');
    Route::get('/chatinfo_edit/{kn}','ManageController@chatinfo_edit');
    Route::post('/chatinfo_update','ManageController@chatinfo_update');
    Route::get('/chatinfo_del/{kn}','ManageController@chatinfo_del');

});


// Route::get('/', function () {
//     return view('welcome');
// });
?>