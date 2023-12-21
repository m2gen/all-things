<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;


Auth::routes();

// トップページ表示
Route::get('/', [HelloController::class, 'index'])->name('top');
// 投票加算
Route::post('/vote/{id}', [HelloController::class, 'voteStore'])->name('vote.store')->middleware('throttle:vote');
// 万物詳細ページ表示
Route::get('/details/{things}', [HelloController::class, 'show'])->name('details');
Route::post('/details/{things}', [HelloController::class, 'commentStore'])->name('comment');
// 検索
Route::get('/search', [HelloController::class, 'search']);
// タグページ
Route::get('/tags/{name}', [HelloController::class, 'showTag'])->name('tags.show');
Route::get('/popTags', [HelloController::class, 'popTagShow'])->name('popTag.show');
// 新規万物登録
Route::get('/article', [HomeController::class, 'show'])->name('article.show');
Route::post('/article', [HomeController::class, 'store'])->name('article.store');

// 万物編集と更新
Route::get('/edit/{things}', [HomeController::class, 'showForm'])->name('edit');
Route::put('/update/{things}', [HomeController::class, 'update'])->name('update');
// 問い合わせページ表示
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
//確認ページ
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('confirm');
//送信完了ページ
Route::post('/contact/thanks', [ContactController::class, 'send'])->name('send');
// ユーザーお気に入りページ
Route::get('/myPage', [HomeController::class, 'myPage'])->name('myPage');
Route::put('/myPage', [HomeController::class, 'name_update'])->name('name.update');
Route::post('/favorites/{id}', [HomeController::class, 'favorites_store'])->name('favorites.store');
Route::delete('/favorites/{id}', [HomeController::class, 'favorites_delete'])->name('favorites.delete');
