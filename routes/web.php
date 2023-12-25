<?php

use Illuminate\Support\Facades\Route;

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
Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')->name('ckfinder_connector');
Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')->name('ckfinder_browser');

// Route::get('/', function () {
//     $data['config'] = DB::table('configs')->pluck('value', 'attribute')->toArray();
//     return view('welcome',$data);
// })->name('index');

// Route::get('/orderId/{orderid}',function () {
//     $data['config'] = DB::table('configs')->pluck('value', 'attribute')->toArray();
//     return view('welcome',$data);
// })->name('orderId');

Route::group(['namespace'=>'Website'], function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('tin-tuc/', 'NewssController@index')->name('news');
    Route::get('new-type/{slug?}', 'NewTypeController@index')->name('newtype');
    Route::get('danh-muc-san-pham/{slug?}', 'CategoryController@index')->name('category');
    Route::get('chi-tiet-tin-tuc/{slug?}', 'NewssDetailController@index')->name('new_detail');
    Route::get('san-pham/{slug?}', 'ProductController@index')->name('product');
    Route::get('ve-chung-toi/', 'AboutController@index')->name('about');
    Route::get('lien-he/', 'ContactController@index')->name('contact');
    Route::get('tim-kiem/{key?}', 'SearchController@searchnew')->name('searchnew');
    Route::get('dang-nhap/', 'LoginController@index')->name('login');
    Route::get('dang-xuat/', 'LogoutController@logout')->name('logout');
    Route::post('dang-nhap/', 'LoginController@login')->name('checklogin');
    Route::get('dang-ky/', 'RegisterController@index')->name('register');
    Route::post('dang-ky/', 'RegisterController@register')->name('checkregister');

});

Route::get('/payment_success', 'TestPayment@getStatusCode')->name('pay_success');

Route::post('/created_order','TestPayment@createOrder')->name('created_order');

// Route::group(['namespace'=>'Website'],function(){
//         Route::get('/tin-tuc', 'NewsController@index')->name('news');
//         Route::get('/chi-tiet-tin-tuc/{slug?}', 'NewsDetailController@index')->name('news-detail');
// });
