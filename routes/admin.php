<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::prefix('content')->name('content.')->group(function () {
    Route::get('{page}', 'ContentController@index')->name('index');
    Route::get('{page}/create', 'ContentController@create')->name('create');
    Route::post('{page}', 'ContentController@store')->name('store');
    Route::get('{page}/{content}/edit', 'ContentController@edit')->name('edit');
    Route::put('{page}/{content}', 'ContentController@update')->name('update');
    Route::delete('{page}/{content}', 'ContentController@destroy')->name('destroy');
});

Route::resource('language', 'LanguageController');
Route::resource('page', 'PageController');
Route::resource('role', 'RoleController');
Route::resource('user', 'UserController');
Route::resource('category', 'CategoryController');
Route::resource('news', 'NewsController');
Route::resource('position', 'PositionController');
Route::resource('image', 'ImageController');
Route::resource('cart', 'CartController');
Route::resource('province', 'ProvinceController');
Route::resource('district', 'DistrictController');
Route::resource('ward', 'WardController');
Route::resource('producer', 'ProducerController');
Route::resource('attribute', 'AttributeController');
Route::resource('product', 'ProductController');
Route::resource('customer', 'CustomerController');
Route::resource('advantages', 'AdvantagesController');
Route::resource('backup', 'BackupController')->except(['edit', 'update', 'show']);
Route::resource('activity', 'LogActivityController')->only(['index', 'destroy']);
Route::get('backup/download/{backup}','BackupController@download')->name('backup.download');

Route::prefix('config')->name('config.')->group(function () {
    Route::get('/', 'ConfigController@edit')->name('edit');
    Route::put('update', 'ConfigController@update')->name('update');
});

Route::prefix('page')->name('page.')->group(function () {
    Route::get('page-translation/{page}', 'PageController@language')->name('language');
    Route::post('page-translation/{page}', 'PageController@translation')->name('translation');
});

Route::prefix('content')->name('content.')->group(function () {
    Route::get('translation/{page}/{content}', 'ContentController@language')->name('language');
    Route::post('translation/{page}/{content}', 'ContentController@translation')->name('translation');
});

Route::prefix('category')->name('category.')->group(function () {
    Route::get('translation/{category}', 'CategoryController@language')->name('language');
    Route::post('translation/{category}', 'CategoryController@translation')->name('translation');
});

Route::prefix('image')->name('image.')->group(function () {
    Route::get('translation/{image}', 'ImageController@language')->name('language');
    Route::post('translation/{image}', 'ImageController@translation')->name('translation');
});

Route::prefix('producer')->name('producer.')->group(function () {
    Route::get('translation/{producer}', 'ProducerController@language')->name('language');
    Route::post('translation/{producer}', 'ProducerController@translation')->name('translation');
});

Route::prefix('attribute')->name('attribute.')->group(function () {
    Route::get('translation/{attribute}', 'AttributeController@language')->name('language');
    Route::post('translation/{attribute}', 'AttributeController@translation')->name('translation');
});

Route::prefix('news')->name('news.')->group(function () {
    Route::get('translation/{news}', 'NewsController@language')->name('language');
    Route::post('translation/{news}', 'NewsController@translation')->name('translation');
    Route::get('detail/{news}', 'NewsController@detail')->name('detail');
    Route::get('seo/{news}', 'NewsController@seo')->name('seo');
});

Route::prefix('product')->name('product.')->group(function () {
    Route::get('translation/{product}', 'ProductController@language')->name('language');
    Route::post('translation/{product}', 'ProductController@translation')->name('translation');
});

Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('translation/{customer}', 'CustomerController@language')->name('language');
    Route::post('translation/{customer}', 'CustomerController@translation')->name('translation');
});

Route::prefix('advantages')->name('advantages.')->group(function () {
    Route::get('translation/{advantages}', 'AdvantagesController@language')->name('language');
    Route::post('translation/{advantages}', 'AdvantagesController@translation')->name('translation');
});

Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', 'ReplyContactController@index')->name('index');
    Route::get('reply/{contact}', 'ReplyContactController@reply')->name('reply');
    Route::post('reply/{contact}', 'ReplyContactController@send_reply')->name('send_reply');
    Route::delete('reply/{contact}', 'ReplyContactController@destroy')->name('destroy');
});

Route::prefix('personal')->name('personal.')->group(function () {
    Route::get('/', 'PersonalController@show')->name('show');
    Route::put('update-account', 'PersonalController@update_account')->name('update_account');
    Route::put('update-avatar', 'PersonalController@update_avatar')->name('update_avatar');
    Route::put('update-info', 'PersonalController@update_info')->name('update_info');
    Route::get('logout', 'PersonalController@logout')->name('logout');
});

Route::prefix('ajax')->name('ajax.')->group(function () {
    Route::get('role-datatables', 'RoleController@dataTableIndex')->name('roleDataTables');
    Route::get('user-datatables', 'UserController@dataTableIndex')->name('userDataTables');
    Route::get('language-datatables', 'LanguageController@dataTableIndex')->name('languageDataTables');
    Route::get('personal-datatables', 'PersonalController@dataTableIndex')->name('personalDataTables');
    Route::get('get-cart', 'CartController@dataTableIndex')->name('CartController');
    Route::get('news-datatables', 'NewsController@dataTableIndex')->name('newsDataTables');
    Route::get('images-datatables', 'ImageController@dataTableIndex')->name('imageDataTables');
    Route::get('page-datatables', 'PageController@dataTableIndex')->name('pageDataTables');
    Route::get('contact-datatables', 'ReplyContactController@dataTableIndex')->name('contactDataTables');
    Route::get('content-datatables/{page}', 'ContentController@dataTableIndex')->name('contentDataTables');
    Route::get('activity-datatables', 'LogActivityController@dataTableIndex')->name('activityDataTables');
    Route::get('province-datatables', 'ProvinceController@dataTableIndex')->name('provinceDataTables');
    Route::get('district-datatables', 'DistrictController@dataTableIndex')->name('districtDataTables');
    Route::get('ward-datatables', 'WardController@dataTableIndex')->name('wardDataTables');
    Route::get('producer-datatables', 'ProducerController@dataTableIndex')->name('producerDataTables');
    Route::get('attribute-datatables', 'AttributeController@dataTableIndex')->name('attributeDataTables');
    Route::get('product-datatables', 'ProductController@dataTableIndex')->name('productDataTables');
    Route::post('get-district-by-province', 'WardController@loadDistrict')->name('loadDistrict');
    Route::get('customer-datatable', 'CustomerController@dataTableIndex')->name('customerDataTable');
    Route::get('advantages-datatable', 'AdvantagesController@dataTableIndex')->name('advantagesDataTable');

    Route::post('select-category-position', 'CategoryController@ajaxSelectCategory')->name('ajaxSelectCategory');
    Route::put('table-category-position', 'CategoryController@ajaxTableCategory')->name('ajaxTableCategory');
    Route::post('select-position-position', 'PositionController@ajaxSelectPosition')->name('ajaxSelectPosition');
    Route::put('table-position-position', 'PositionController@ajaxTablePosition')->name('ajaxTablePosition');
    Route::post('select-position-image', 'ImageController@ajaxSelectPositionImages')->name('ajaxSelectPositionImages');
    Route::post('select-attribute-position', 'AttributeController@ajaxSelectAttribute')->name('ajaxSelectAttribute');

    Route::post('add-notification','AjaxController@addNotification')->name('addNotification');
    Route::post('make-as-read','AjaxController@MakeAsReadNoti')->name('MakeAsReadNoti');
    Route::post('add-row-upload-image', 'AjaxController@addRowUploadImage')->name('addRowUploadImage');
    Route::post('add-row-upload-attribute', 'AjaxController@addRowUploadAttribute')->name('addRowUploadAttribute');
    Route::post('get-district', 'AjaxController@getDistrict')->name('getDistrict');
    Route::post('get-ward', 'AjaxController@getWard')->name('getWard');
});

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('lang/{locale}', 'DashboardController@locale')->name('locale');
