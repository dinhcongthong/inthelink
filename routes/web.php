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

// authenticate routes
Route::get('/forgot_password', 'Auth\ForgotPasswordController@forgot')->name('forgot_password');
Route::post('/forgot_check', 'Auth\ResetPasswordController@check')->name('post_forgot');
Route::get('/reset-password/{token?}',"Auth\ResetPasswordController@form_reset");
Route::post('/reset-password',"Auth\ResetPasswordController@reset")->name('post_reset_password');

Route::get('/login',"HomeController@login")->name('login');
Route::post('/login',"Auth\LoginController@login")->name('post_login');

Route::get('/register/{position?}', "HomeController@register")->name('register');
Route::post('/register',"Auth\RegisterController@create")->name('post_register');

Route::get('/logout', 'Auth\LoginController@logout');

// page
Route::get('/products/{article?}', "HomeController@ProductDetail")->name('product_detail');
Route::post('/profile', "HomeController@profileUpdate")->name('post_profile');
Route::get('/',"HomeController@index")->name('home');

Route::get('/home-influencer',"HomeController@influencer")->name('home_influencer');

Route::get('/team',"HomeController@team")->name('team');


Route::get('register/verify/{code}', 'Auth\RegisterController@verify')->name('register_verify');

