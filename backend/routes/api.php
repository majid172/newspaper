<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Frontend\ArticleController;
use App\Http\Controllers\Api\Backend\ArticleController as BackendArticleController;
use App\Http\Controllers\Api\Backend\CategoryController;
use App\Http\Controllers\Api\Frontend\ArticleShowController;
use App\Http\Controllers\Api\Frontend\HomeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/home', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/{category:slug}', [ArticleController::class, 'index'])->name('frontend.category');
Route::get('/news/{id}', [ArticleShowController::class, 'show'])->name('news.show');

Route::prefix('admin')->name('backend.')->group(function () {
    Route::get('/articles', [BackendArticleController::class, 'index'])->name('articles');
    Route::get('/category',[CategoryController::class, 'index'])->name('category');
    Route::post('/create/category',[CategoryController::class, 'store'])->name('create.category');
});
