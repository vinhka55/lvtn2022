<?php

use Illuminate\Support\Facades\Route;

//trang chủ
Route::get('/','App\Http\Controllers\HomeController@index');

//hiển thị sản phẩm theo danh mục
Route::get('danh-muc/{id_danh_muc}','App\Http\Controllers\CategoryController@index')->name('danh_muc_san_pham');

//trang chủ admin page
Route::get('admin','App\Http\Controllers\AdminController@index')->name('admin');

//category
Route::get('them-danh-muc','App\Http\Controllers\CategoryController@add_category')->name('add_category');
Route::post('xu-ly-them-danh-muc','App\Http\Controllers\CategoryController@handle_add')->name('handle_add_category');
Route::get('danh-sach-danh-muc','App\Http\Controllers\CategoryController@list')->name('list_category');
Route::get('xoa-danh-muc/{id}','App\Http\Controllers\CategoryController@delete')->name('delete_category');
Route::get('sua-danh-muc/{id}','App\Http\Controllers\CategoryController@edit')->name('edit_category');
Route::post('xu-ly-sua-danh-muc/{id}','App\Http\Controllers\CategoryController@handle_edit')->name('handle_edit_category');
Route::get('sua-trang-thai/{id}','App\Http\Controllers\CategoryController@edit_status')->name('edit_status');

//product
Route::get('them-san-pham','App\Http\Controllers\ProductController@add')->name('add_product');
Route::post('xu-ly-them-san-pham','App\Http\Controllers\ProductController@handle_add')->name('handle_add_product');
Route::get('danh-sach-san-pham','App\Http\Controllers\ProductController@list')->name('list_product');
Route::get('sua-trang-thai-san-pham/{id}','App\Http\Controllers\ProductController@edit_status')->name('edit_status_product');
Route::get('xoa-san-pham/{id}','App\Http\Controllers\ProductController@delete')->name('delete_product');
Route::get('san-pham/{id}','App\Http\Controllers\ProductController@detail')->name('detail_product');

//cart 
Route::get('gio-hang','App\Http\Controllers\CartController@get_mothod_shopping_cart')->name('get_mothod_shopping_cart');
Route::post('gio-hang','App\Http\Controllers\CartController@shopping_cart')->name('shopping_cart');
Route::post('cap-nhat-gio-hang/{uid}','App\Http\Controllers\CartController@update')->name('update_cart');
Route::get('xoa-san-pham-trong-gio-hang/{uid}','App\Http\Controllers\CartController@delete_product')->name('delete_product_in_cart');
Route::post('add-cart-ajax','App\Http\Controllers\CartController@add_cart_ajax')->name('add-cart-by-ajax');
Route::get('xoa-tat-ca-san-pham-trong-gio-hang','App\Http\Controllers\CartController@delete_all')->name('delete-all-product-in-cart');


//checkout
Route::get('dang-nhap','App\Http\Controllers\CheckoutController@login')->name('login');
Route::get('dang-xuat','App\Http\Controllers\CheckoutController@logout')->name('logout');
Route::post('dang-ki-tai-khoan','App\Http\Controllers\CheckoutController@register')->name('register');
Route::post('xu-ly-dang-nhap','App\Http\Controllers\CheckoutController@handle_login')->name('handle_login');
Route::get('thanh-toan','App\Http\Controllers\CheckoutController@pay')->name('pay_product');
Route::post('phuong-thuc-thanh-toan','App\Http\Controllers\CheckoutController@payment_method')->name('payment_method');

//order
Route::post('dat-hang','App\Http\Controllers\CheckoutController@order_place')->name('order_place');
Route::get('danh-sach-don-hang','App\Http\Controllers\CheckoutController@list_order')->name('list_order');
Route::get('chi-tiet-don-hang/{orderId}','App\Http\Controllers\CheckoutController@detail_order')->name('detail_order');
Route::get('xoa-don-hang/{orderId}','App\Http\Controllers\CheckoutController@delete_order')->name('delete_order');

//user
Route::get('thong-tin-tai-khoan','App\Http\Controllers\InfoUserController@show_info')->name('info_user');

//search product
Route::post('tim-kiem-san-pham','App\Http\Controllers\HomeController@search')->name('search_product');

//coupon
Route::get('them-ma-giam-gia','App\Http\Controllers\CouponController@insert')->name('insert_coupon');
Route::post('xu-ly-them-ma-giam-gia','App\Http\Controllers\CouponController@handle_insert')->name('handle_insert_coupon');
Route::get('danh-sach-ma-giam-gia','App\Http\Controllers\CouponController@list')->name('list_coupon');
Route::post('giam-gia','App\Http\Controllers\CouponController@discount')->name('discount');
Route::get('xoa-ma-giam-gia/{id}','App\Http\Controllers\CouponController@delete')->name('delete_coupon');

