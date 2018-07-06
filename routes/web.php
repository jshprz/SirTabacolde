<?php

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

Route::get('/', function () {
    return view('client-side.landingpage');
});
Route::get('/registration',function(){
	return view('client-side.registration');
});
Route::get('/login',function(){
	return view('client-side.login');
})->name('login');
Route::get('register/{token}','Auth\RegisterController@confirmToken');
Route::post('/register','Auth\RegisterController@register')->name('register');
Route::post('/login','Auth\LoginController@dologin')->name('dologin');

Route::group(['middleware'=>['auth']],function(){
Route::get('/profile', function(){
	return view('client-side.profile');
})->name('profile');
});