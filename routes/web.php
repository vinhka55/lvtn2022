<?php

use Illuminate\Support\Facades\Route;

//trang chủ
Route::get('/','App\Http\Controllers\HomeController@index');

//hiển thị sản phẩm theo danh mục
Route::get('danh-muc/{id_danh_muc}','App\Http\Controllers\CategoryController@index')->name('danh_muc_san_pham');

//trang chủ admin page
Route::get('admin','App\Http\Controllers\AdminController@index')->name('admin')->middleware('auth.admin.author');

//category
Route::middleware(['auth.admin.author'])->group(function(){
        Route::get('them-danh-muc','App\Http\Controllers\CategoryController@add_category')->name('add_category');
        Route::post('xu-ly-them-danh-muc','App\Http\Controllers\CategoryController@handle_add')->name('handle_add_category');
        Route::get('danh-sach-danh-muc','App\Http\Controllers\CategoryController@list')->name('list_category');
        Route::get('xoa-danh-muc/{id}','App\Http\Controllers\CategoryController@delete')->name('delete_category');
        Route::get('sua-danh-muc/{id}','App\Http\Controllers\CategoryController@edit')->name('edit_category');
        Route::post('xu-ly-sua-danh-muc/{id}','App\Http\Controllers\CategoryController@handle_edit')->name('handle_edit_category');
        Route::get('sua-trang-thai/{id}','App\Http\Controllers\CategoryController@edit_status')->name('edit_status');
    }
);

//product
Route::middleware(['auth.admin.author'])->group(function(){
        Route::get('them-san-pham','App\Http\Controllers\ProductController@add')->name('add_product');
        Route::post('xu-ly-them-san-pham','App\Http\Controllers\ProductController@handle_add')->name('handle_add_product');
        Route::get('danh-sach-san-pham','App\Http\Controllers\ProductController@list')->name('list_product');
        Route::get('sua-trang-thai-san-pham/{id}','App\Http\Controllers\ProductController@edit_status')->name('edit_status_product');
        Route::get('xoa-san-pham/{id}','App\Http\Controllers\ProductController@delete')->name('delete_product');
    }
);
Route::get('san-pham/{id}','App\Http\Controllers\ProductController@detail')->name('detail_product');

//cart 
Route::get('gio-hang','App\Http\Controllers\CartController@get_mothod_shopping_cart')->name('get_mothod_shopping_cart');
Route::post('gio-hang','App\Http\Controllers\CartController@shopping_cart')->name('shopping_cart');
Route::post('cap-nhat-gio-hang','App\Http\Controllers\CartController@update')->name('update_cart');
Route::get('xoa-san-pham-trong-gio-hang/{uid}','App\Http\Controllers\CartController@delete_product')->name('delete_product_in_cart');
Route::post('add-cart-ajax','App\Http\Controllers\CartController@add_cart_ajax')->name('add-cart-by-ajax');
Route::get('xoa-tat-ca-san-pham-trong-gio-hang','App\Http\Controllers\CartController@delete_all')->name('delete-all-product-in-cart');
Route::get('dem-san-pham-trong-cart-menu','App\Http\Controllers\CartController@show_cart_menu')->name('show_cart_menu');
Route::get('hover-san-pham-trong-cart-menu','App\Http\Controllers\CartController@hover_cart_menu')->name('hover_cart_menu');

//checkout

Route::get('thanh-toan','App\Http\Controllers\CheckoutController@pay')->name('pay_product');
Route::post('phuong-thuc-thanh-toan','App\Http\Controllers\CheckoutController@payment_method')->name('payment_method');

//order
Route::middleware(['auth.admin.author'])->group(function(){
        Route::get('danh-sach-don-hang','App\Http\Controllers\OrderController@list_order')->name('list_order');
        Route::get('xoa-don-hang/{orderId}','App\Http\Controllers\OrderController@delete_order')->name('delete_order');
        Route::get('chi-tiet-don-hang/{orderId}','App\Http\Controllers\OrderController@detail_order')->name('detail_order');
    }
);
Route::post('dat-hang','App\Http\Controllers\OrderController@order_place')->name('order_place');
Route::post('cap-nhat-trang-thai-san-pham-cua-don-hang','App\Http\Controllers\OrderController@update_status_of_product')->name('update_status_of_product_in_order');
Route::get('xoa-san-pham-trong-don-hang/{id}','App\Http\Controllers\OrderController@delete_product_in_order')->name('delete_product_in_order');
Route::post('cap-nhat-so-luong-san-pham-trong-don-hang','App\Http\Controllers\OrderController@update_qty_product_in_order')->name('update_qty_product_in_order');
Route::get('don-hang-cua-toi','App\Http\Controllers\OrderController@my_order')->name('my_order');
Route::get('chi-tiet-don-hang-cua-toi/{id}','App\Http\Controllers\OrderController@detail_my_order')->name('detail_my_order');
Route::post('huy-don-hang','App\Http\Controllers\OrderController@customer_cancel_order')->name('customer_cancel_order');



//user người mua hàng
Route::get('thong-tin-tai-khoan','App\Http\Controllers\InfoUserController@show_info')->name('info_user');

//search product
Route::post('tim-kiem-san-pham','App\Http\Controllers\HomeController@search')->name('search_product');

//coupon
Route::middleware(['auth.admin.author'])->group(function(){
        Route::get('them-ma-giam-gia','App\Http\Controllers\CouponController@insert')->name('insert_coupon');
        Route::post('xu-ly-them-ma-giam-gia','App\Http\Controllers\CouponController@handle_insert')->name('handle_insert_coupon');
        Route::get('danh-sach-ma-giam-gia','App\Http\Controllers\CouponController@list')->name('list_coupon');
        Route::get('sua-ma-giam-gia/{id}','App\Http\Controllers\CouponController@edit')->name('edit_coupon');
        Route::post('xu-ly-sua-ma-giam-gia','App\Http\Controllers\CouponController@handle_edit')->name('handle_edit_coupon');
        Route::get('xoa-ma-giam-gia/{id}','App\Http\Controllers\CouponController@delete')->name('delete_coupon');
    }
);
Route::post('giam-gia','App\Http\Controllers\CouponController@discount')->name('discount');

//admin login, register

Route::get('admin/register-auth','App\Http\Controllers\AuthController@register_auth')->name('register');
Route::post('admin/handle-register-auth','App\Http\Controllers\AuthController@handle_register')->name('handle_register_admin');
Route::get('admin/login','App\Http\Controllers\AuthController@login')->name('login_admin');
Route::post('admin/handle-login','App\Http\Controllers\AuthController@handle_login')->name('handle_login');
Route::get('admin/logout','App\Http\Controllers\AuthController@logout')->name('admin_logout');

//user
Route::middleware(['auth.admin'])->group(function(){
        Route::get('list-user','App\Http\Controllers\UserController@index')->name('list_user');
        Route::post('assign-roles','App\Http\Controllers\UserController@assign_roles')->name('assign_roles');
        Route::get('delete-user/{id}','App\Http\Controllers\UserController@delete')->name('delete_user');
    }
);
Route::post('thay-doi-avatar','App\Http\Controllers\UserController@user_change_avatar')->name('user_change_avatar');


//print pdf file
Route::get('in-don-hang/{order_id}','App\Http\Controllers\PdfController@print_order')->name('print_order');

//payment online
Route::post('thanh-toan-momo','App\Http\Controllers\PaymentOnlineController@momo')->name('momo');
Route::get('xu-ly-thanh-toan-momo','App\Http\Controllers\PaymentOnlineController@handle_momo')->name('handle_momo');

//comment   
Route::post('danh-sach-binh-luan-tung-san-pham','App\Http\Controllers\CommentController@show_comment')->name('show_comment');
Route::post('binh-luan-san-pham','App\Http\Controllers\CommentController@send_comment')->name('send_comment');
Route::get('admin/danh-sach-binh-luan','App\Http\Controllers\CommentController@list_comment')->name('list_comment');
Route::post('admin/thay-doi-trang-thai-comment','App\Http\Controllers\CommentController@change_status_comment')->name('change_status_comment');
Route::post('admin/admin-tra-loi-comment','App\Http\Controllers\CommentController@admin_rep')->name('admin_rep');

//login and login social
Route::get('dang-nhap-bang-google-mail','App\Http\Controllers\LoginController@login_google')->name('login_google');
Route::get('google/callback','App\Http\Controllers\LoginController@callback_google')->name('callback_google');
Route::get('dang-nhap','App\Http\Controllers\LoginController@login')->name('login');
Route::get('dang-xuat','App\Http\Controllers\LoginController@logout')->name('logout');
Route::post('dang-ki-tai-khoan','App\Http\Controllers\LoginController@register')->name('register_customer');
Route::post('xu-ly-dang-nhap','App\Http\Controllers\LoginController@handle_login')->name('handle_login_customer');

//category news 
Route::get('them-danh-muc-tin-tuc','App\Http\Controllers\CategoryNewsController@add_category')->name('add_category_news');
Route::post('xu-ly-them-danh-muc-tin-tuc','App\Http\Controllers\CategoryNewsController@handle_add_category')->name('handle_add_category_news');
Route::get('danh-sach-danh-muc-tin-tuc','App\Http\Controllers\CategoryNewsController@list')->name('list_category_news');
Route::get('sua-trang-thai-danh-muc-tin-tuc/{id}','App\Http\Controllers\CategoryNewsController@edit_status')->name('edit_status_category_news');
Route::get('xoa-danh-muc-tin-tuc/{id}','App\Http\Controllers\CategoryNewsController@delete')->name('delete_category_news');
Route::get('sua-danh-muc-tin-tuc/{id}','App\Http\Controllers\CategoryNewsController@edit_category_news')->name('edit_category_news');
Route::post('xu-ly-sua-danh-muc-tin-tuc','App\Http\Controllers\CategoryNewsController@handle_edit_category_news')->name('handle_edit_category_news');

//news
Route::get('them-tin-tuc','App\Http\Controllers\NewsController@insert')->name('add_news');
Route::post('xu-ly-them-tin-tuc','App\Http\Controllers\NewsController@handle_insert')->name('handle_insert_news');
Route::get('danh-sach-tin-tuc','App\Http\Controllers\NewsController@list')->name('list_news');
Route::get('xoa-danh-sach-tin-tuc/{id}','App\Http\Controllers\NewsController@delete')->name('delete_news');
Route::get('sua-danh-sach-tin-tuc/{id}','App\Http\Controllers\NewsController@edit')->name('edit_news');
Route::post('xu-ly-sua-danh-sach-tin-tuc','App\Http\Controllers\NewsController@handle_edit')->name('handle_edit_news');
Route::get('sua-trang-thai-tin-tuc/{id}','App\Http\Controllers\NewsController@edit_status')->name('edit_status_news');
