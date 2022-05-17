<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteController;
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

Route::get('/', function () {
    return view('home');
});
Route::get('/admin', function () {
    return view('layouts.admin.main');
});

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/product/{id}', 'detail');
    Route::post('/product/{id}/comment', 'saveComment');
    Route::get('/product/{id}/favorite', 'setfavoriteProduct');
    Route::get('/list/{type?}/{id?}', 'listProducts');
    Route::get('/list-favorite', 'listFavorite');
    Route::get('/cart', 'cart');
    Route::get('/cart/add/{id}/{quantity?}', 'addCart');
    Route::get('/cart/delete/{id}', 'deleteCart');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/admin/category', 'index');
    Route::get('/admin/category/create', 'create');
    Route::post('/admin/category/create', 'saveCreate');
    Route::get('/admin/category/{id}/edit', 'edit');
    Route::put('/admin/category/{id}/edit', 'saveEdit');
    Route::delete('/admin/category/{id}', 'remove');
});

Route::controller(BrandController::class)->group(function () {
    Route::get('/admin/brands', 'index');
    Route::get('/admin/brands/create', 'create');
    Route::post('/admin/brands/create', 'saveCreate');
    Route::get('/admin/brands/{id}/edit', 'edit');
    Route::put('/admin/brands/{id}/edit', 'saveEdit');
    Route::delete('/admin/brands/{id}', 'remove');
});

Route::controller(ColorController::class)->group(function () {
    Route::get('/admin/colors', 'index');
    Route::get('/admin/colors/create', 'create');
    Route::post('/admin/colors/create', 'saveCreate');
    Route::get('/admin/colors/{id}/edit', 'edit');
    Route::put('/admin/colors/{id}/edit', 'saveEdit');
    Route::delete('/admin/colors/{id}', 'remove');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/admin/products', 'index');
    Route::get('/admin/products/create', 'create');
    Route::post('/admin/products/create', 'saveCreate');
    Route::get('/admin/products/{id}/edit', 'edit');
    Route::put('/admin/products/{id}/edit', 'saveEdit');
    Route::delete('/admin/products/{id}', 'remove');
});
