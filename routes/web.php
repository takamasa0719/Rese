<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ThanksController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PaymentController;

Route::get('/', [ShopController::class, 'index']);

Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);

Route::get('/thanks', [ThanksController::class, 'thanks']);

Route::get('/search', [ShopController::class, 'search']);

Route::group(['middleware' => ['auth', 'can:general', 'verified']], function(){
    Route::get('/reserve', [ReservationController::class, 'reserve']);
    Route::post('/reserve/payment', [PaymentController::class, 'payment']);
    Route::post('/reserve/update/{reserve_id}', [ReservationController::class, 'update']);
    Route::post('/reserve/delete/{reserve_id}', [ReservationController::class, 'delete']);
    Route::get('/done', [ReservationController::class, 'done']);

    Route::get('/mypage', [UserController::class, 'mypage']);

    Route::post('/review/{shop_id}', [ReviewController::class, 'review']);
    Route::post('/review/update/{review_id}', [ReviewController::class, 'update']);

    Route::post('/favorite/{shop_id}', [FavoriteController::class, 'favorite']);
    Route::post('/favorite/delete/{favorite_id}', [FavoriteController::class, 'unfavorite']);
});


Route::group(['middleware' => ['auth', 'can:admin']], function(){
    Route::get('/admin', [UserController::class, 'admin']);
    Route::post('/owner/add', [OwnerController::class, 'owner']);
    Route::post('/owner/delete/{owner_id}', [OwnerController::class, 'delete']);
});

Route::group(['middleware' => ['auth', 'can:owner']], function(){
    Route::get('/owner', [OwnerController::class, 'index']);
    Route::post('/shop/add', [ShopController::class, 'add']);
    Route::post('/shop/update/{shop_id}', [ShopController::class, 'update']);
    Route::get('/reserve/check/{reserve_id}', [ReservationController::class, 'confirm']);
    Route::post('/reserve/check/{reserve_id}', [ReservationController::class, 'check']);
});

