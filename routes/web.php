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

Route::get('/register', 'PageController@register');
Route::post('/registUser', 'UsersController@store');

Route::post('/loginUser', 'LoggedController@login');
Route::get('/logout', 'LoggedController@logout');

Route::middleware(['guest'])->group(function(){
	Route::get('/', 'PageController@index')->name('login');
});

Route::middleware(['auth','UserRole:1'])->group(function(){
	Route::get('/dashboard-admin', 'DashboardAdminController@index');
	Route::get('/user-management', 'DashboardAdminController@userEdit');
	Route::post('/showUser', 'DashboardAdminController@show')->name('show');
	Route::put('/user-management', 'DashboardAdminController@userUpdate');
	Route::get('/send-notification', 'DashboardAdminController@notification');
	Route::post('/sendNotif', 'DashboardAdminController@sendNotif');
	Route::get('/product-management', 'DashboardAdminController@productEdit');
	Route::post('/addProduct', 'DashboardAdminController@addProduct')->name('addProduct');
	Route::post('/updateProduct', 'DashboardAdminController@updateProduct')->name('updateProduct');
	Route::put('/updateProduct', 'DashboardAdminController@updatingProduct')->name('updatingProduct');

	Route::get('/updateEmoney', 'DashboardAdminController@updateEmoney');
	Route::get('/updatePulsa', 'DashboardAdminController@updatePulsa');
	Route::get('/updateData', 'DashboardAdminController@updateData');
	Route::get('/updateVData', 'DashboardAdminController@updateVData');
	Route::get('/updateGame', 'DashboardAdminController@updateGame');
});

Route::middleware(['auth','UserRole:1,2'])->group(function(){
	Route::get('/getMessage', 'DashboardController@msg');
	Route::get('/dashboard', 'DashboardController@index');
	Route::get('/profile', 'DashboardController@profile');
	Route::put('/profile', 'DashboardController@updateProfile');
	Route::get('/public-chat', 'DashboardController@chatPublic');
	Route::post('/sendMessage', 'DashboardController@sendMessage');
	Route::get('/showPublicChat', 'DashboardController@showPublicRefresh')->name('showPublic');
	Route::get('/verifyEmail', 'DashboardController@verifyEmail');
	Route::post('/getCode', 'DashboardController@getCode');
	Route::get('/verify', 'DashboardController@getVerify');
	Route::post('/verify', 'DashboardController@postVerify');
	Route::get('/support', 'DashboardController@support');

	Route::get('/home', 'ShopController@index');
	Route::post('/userSelect', 'ShopController@userSelect')->name('userSelect');
	Route::get('/showSelect/{product}/{type}', 'ShopController@showSelect');
	Route::post('/showPrice', 'ShopController@showPrice')->name('showPrice');
	Route::post('/showPriceMoney', 'ShopController@showPriceMoney')->name('showPriceMoney');
	Route::get('/history-transaksi', 'ShopController@historyTransaksi');
	Route::post('/eMoney', 'ShopController@eMoney')->name('eMoney');
	Route::post('/showGame', 'ShopController@showGame')->name('showGame');
	Route::post('/showPriceGame', 'ShopController@showPriceGame')->name('showPriceGame');
	Route::post('/statusOrder', 'ShopController@statusOrder');
	Route::post('/support', 'ShopController@refund'); //refund
	
	Route::post('/userBuy', 'UserBuyController@UserPpob')->name('userBuy');

	Route::post('/userBuyGame', 'UserBuyController@userBuyGame')->name('userBuyGame');
});