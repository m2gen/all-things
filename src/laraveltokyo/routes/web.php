<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Auth::routes();

// トップページ表示
Route::get('/', [HelloController::class, 'index'])->name('top');
Route::post('/vote/{id}', [HelloController::class, 'storeOrUpdate'])->name('vote.store');
// 万物詳細ページ表示
Route::get('/details/{things}', [HelloController::class, 'show'])->name('details');
// 新規万物登録
Route::get('/article', [HomeController::class, 'show'])->name('article.show');
Route::post('/article', [HomeController::class, 'store'])->name('article.store');
// 万物更新
Route::get('/edit/{things}', [HomeController::class, 'showForm'])->name('edit');
Route::post('/update/{things}', [HomeController::class, 'update'])->name('update');
// 検索
Route::get('/search', [HelloController::class, 'search']);
