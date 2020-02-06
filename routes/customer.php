<?php

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Customer routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Customer" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->route('customer.ordered');
});

Route::get('/checkout',"CustomerController@getCheckout")->name('get_checkout');
Route::post('/post-checkout', "CustomerController@postCheckout")->name('post_checkout');

// ajax load payment method account number
// Route::post('/load-acc-number', "CustomerController@loadAccNumber");

Route::get('/ordered',"CustomerController@getOrdered")->name('ordered');
Route::post('/post-payment-momo', "CustomerController@postPaymentMomo")->name('post_payment_momo');
Route::get('/order/detail/{id?}',"CustomerController@OrderDetail")->name('order_detail');
Route::post('/order/post-evaluation', "CustomerController@postEvaluation");
Route::post('/order/cancel/{id}', "CustomerController@postCancelOrder");

Route::get('/profile',"CustomerController@getProfile")->name('get_profile');

Route::get('/addresses',"CustomerController@Address")->name('get_addresses');
Route::post('/post-address', "CustomerController@postAddress");
Route::get('/address-default', "CustomerController@addressSetDefault");
Route::post('/address-delete', "CustomerController@deleteAddress");

// pending
// Route::get('/bank',"CustomerController@Bank");
