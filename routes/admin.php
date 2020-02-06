<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/
//overview
Route::get('/', function () {
    return redirect()->route('admin.order.index');
})->name('index');
Route::get('login', "BaseController@getLogin")->name('login');
Route::post('login', "BaseController@postLogin")->name('post_login');

//settings
Route::prefix('setting')->name('setting.')->group(function () {
    Route::get('profile', "SettingController@Profile")->name('profile');
    Route::post('post-update-profile', "SettingController@postUpdateProfile")->name('post_update_profile');
    Route::post('post-update-password', "SettingController@changeUserPassword");
    Route::get('inthelink', "SettingController@inthelink")->name('inthelink');
    Route::post('inthelink', "SettingController@postInthelink")->name('post_inthelink_info');
});

// orders
Route::prefix('order')->name('order.')->group(function () {
    Route::get('status', "PaymentController@OrderStatus")->name('index');
    // order status table
    Route::post('datatable/{action?}', "PaymentController@OrderStatusTables");
});

//ecommerce
Route::prefix('ecommerce')->name('ecommerce.')->group(function () {

    // Route::get('orderstatus', "PaymentController@OrderStatus")->name('order_status');
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', "CategoryController@index")->name('index');
        Route::post('/over-view-table', "CategoryController@overViewTable");
        Route::get('/detail-table', "CategoryController@loadDetailTable");
        Route::post('/post-update', "CategoryController@postUpdate")->name('post_update');
        Route::get('/get-childs', "CategoryController@getChilds");
        Route::get('detail/{id?}', "CategoryController@detail")->name('detail');
        Route::get('update/{id?}', "CategoryController@getUpdate")->name('get_update');
        Route::post('post-update/{id?}', "CategoryController@postUpdate")->name('post_update');

        Route::get('sub', "CategoryController@subIndex")->name('sub');
        Route::post('/sub-cate-table', "CategoryController@loadSubTables");
        Route::get('sub/last', "CategoryController@CategoryLast")->name('last');
        Route::get('sub/last/products', "CategoryController@CategoryLastProducts")->name('last_products');
        Route::get('product', "CategoryController@CategoryProduct")->name('product');
    });
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', "ProductController@index")->name('index');
        Route::post('load-data-table', "ProductController@loadDataTable");
        Route::get('update/{id?}', "ProductController@getUpdate")->name('get_update');
        Route::post('post-update/{id?}', "ProductController@postUpdate")->name('post_update');
        Route::get('detail/{id?}', "ProductController@ProductDetail")->name('detail');
        Route::post('post-action/{id?}', "ProductController@postAction")->name('post_action');
    });
});

//users
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', function () {
        return \redirect()->route('admin.users.influencer');
    })->name('index');
    // if action = '' is index else list user was bloked
    Route::post('datatables/{action?}', "UserController@userTables");

    Route::get('influencer', "UserController@influencer")->name('influencer');
    // influencer index datatables
    Route::post('influencer-table/{status?}', "UserController@influencerTable");
    Route::get('influencer/detail/{id?}', "UserController@InfluencerDetail")->name('influencer_detail');
    // request include: product_id, influencer_id
    Route::post('influencer-order-table', "UserController@influencerOrderTable");
    Route::post('influencer-payment-table/{influ_id?}', "UserController@influencerPaymentTable");
    // ajax change influencer-payment-status
    Route::post('influencer-payment-status', "UserController@postInfluencerPaymentStatus");
    Route::post('influencer/approved', "UserController@postInfluencerApproved")->name('influencer_approved');
    // ajax change commission percent
    Route::post('influencer/commission', "UserController@postChangeCommissionPercent");
    // ajax change role user
    Route::post('change-role', "UserController@postChangeRole");
    // ajax update status
    Route::post('update-status', "UserController@postUpdateStatus");
    Route::get('manage', "UserController@ManageUsers")->name('manage_users');
    Route::get('blocklist', "UserController@Blocklist")->name('block_list');

    Route::get('customer/detail/{id?}', "UserController@CustomerDetail")->name('customer_detail');

});

//payments
Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('influencer', "PaymentController@influencer")->name('influencer');
    Route::get('influencer/detail/{order_id?}', "PaymentController@influencerDetail")->name('influencer_detail');
    Route::get('revenue', "PaymentController@revenue")->name('revenue');
    // revenue tables
    Route::post('revenue-tables/{action?}', "PaymentController@revenueTables");
    // ajax update payment status for influencer let's use it again: Route::post('influencer-payment-status', "UserController@postInfluencerPaymentStatus");
    // ajax update order status
    Route::post('update-orderstatus', "PaymentController@postUpdateOrderStatus");
});
