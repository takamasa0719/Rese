<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ThanksController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;

Route::get('/', [ShopController::class, 'index']);

Route::get('/done', [ReservationController::class, 'done']);

Route::post('/favorite/{shop_id}', [FavoriteController::class, 'favorite']);

Route::post('/favorite/delete/{id}', [FavoriteController::class, 'unfavorite']);

Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);

Route::get('/thanks', [ThanksController::class, 'thanks']);


