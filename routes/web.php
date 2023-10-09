<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//PUBLIC ROUTES
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

//ARTICLE ROUTES
// Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');
// Route::get('/article/{article}/show', [ArticleController::class, 'show'])->name('article.show');
// Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create')->middleware('auth');
// Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store')->middleware('auth');
// Route::get('/article/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit')->middleware('auth');
// Route::put('/article/{article}/update', [ArticleController::class, 'update'])->name('article.update')->middleware('auth');
// Route::delete('/article/{article}/destroy', [ArticleController::class, 'destroy'])->name('article.destroy')->middleware('auth');
Route::resource('article', ArticleController::class);

//AUTHOR ROUTES
Route::resource('author', AuthorController::class);

//category ROUTES
Route::resource('category', CategoryController::class);


