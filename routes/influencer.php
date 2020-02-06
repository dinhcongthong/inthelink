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

// frontpage
Route::get('/',function(){
    return redirect()->route('influencer.products');
});
// PRODUCT
Route::get('/products',"InfluencerController@products")->name('products');
// Route::get('/shop',"InfluencerController@shop");
// Route::get('/products/detail',"InfluencerController@Detail");

//backpage
Route::get('/selected-list',"InfluencerController@getSelected")->name('get_selected');
Route::post('/update-selected-list', "InfluencerController@updateSelected");

Route::get('/bank',"InfluencerController@bank")->name('get_bank');
Route::post('/bank', "InfluencerController@bankUpdate")->name('post_bank');

Route::get('/sell-history',"InfluencerController@sellHistory")->name('sell_history');
Route::get('/sell-history-table',"InfluencerController@sellHistoryTable");

Route::get('/profile',"InfluencerController@profile")->name('get_profile');

// Route::get('/social',"InfluencerController@Social");

Route::get('/identify',"InfluencerController@identify")->name('get_identify');
Route::post('/identify', "InfluencerController@identifyUpload")->name('post_identify');
