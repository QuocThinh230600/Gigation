<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register auth routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('verify/{token}', 'Verify')->name('verify');
Route::get('change-password/{token}', 'ForgotController@showChangePasswordForm')->name('showChangePasswordForm');
Route::post('change-password/{token}', 'ForgotController@changePassword')->name('changePassword');
Route::get('captcha', 'Captcha')->name('captcha');
Route::get('register', 'RegisterController@showRegisterForm')->name('showRegisterForm');
Route::post('register', 'RegisterController@register')->name('register');
Route::get('login', 'LoginController@showLoginForm')->name('showLoginForm');
Route::post('login', 'LoginController@login')->name('login');
Route::get('logout', 'LoginController@logout')->name('logout');
Route::get('forgot-password', 'ForgotController@showForgotForm')->name('showForgotForm');
Route::post('forgot-password', 'ForgotController@forgot')->name('forgot');
Route::get('logout', 'Logout')->name('logout');
Route::get('login/{provider}','SocialController@redirectToProvider')->name('redirectToProvider');
Route::get('login/{provider}/redirect','SocialController@handleProviderCallback')->name('handleProviderCallback');
