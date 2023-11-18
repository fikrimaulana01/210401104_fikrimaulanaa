<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\DashboardController;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/author', [AuthorController::class, 'index'])->name('list-author');
    Route::get('/author/register', [AuthorController::class, 'register'])->name('register-author');
    Route::post('/author', [AuthorController::class, 'store'])->name('store-author');
    Route::get('/author/edit/{id}', [AuthorController::class, 'edit'])->name('edit-author');
    Route::put('/author/{id}', [AuthorController::class, 'update'])->name('update-author');
    Route::delete('/author/{id}', [AuthorController::class, 'destroy'])->name('author-destroy');
    Route::get('/categories', [CategoriesController::class, 'index'])->name('list-categories');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('create-categories');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('store-categories');
    Route::get('/categories/edit/{id}', [CategoriesController::class, 'edit'])->name('edit-categories');
    Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('update-categories');
    Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('categories-destroy');
    Route::get('/article', [ArticlesController::class, 'index'])->name('article');
    Route::get('article/{url}', [ArticlesController::class, 'view'])->name('view-article');
    Route::get('/articles/create', [ArticlesController::class, 'create'])->name('create-article');
    Route::post('/article', [ArticlesController::class, 'store'])->name('store-article');
    Route::get('/article/edit/{id}', [ArticlesController::class, 'edit'])->name('edit-article');
    Route::put('/article/{id}', [ArticlesController::class, 'update'])->name('update-article');
    Route::delete('/articles/{id}', [ArticlesController::class, 'destroy'])->name('articles-destroy');
    Route::get('/author/register', [AuthorController::class, 'register'])->name('register-author');
    Route::post('/logout', [AuthorController::class, 'logout'])->name('logout');

    // Tambahkan rute lain jika diperlukan
    
});

Route::get('/', [AuthorController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthorController::class, 'login']);