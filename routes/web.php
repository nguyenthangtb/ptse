<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.store');
Route::get('/tin-tuc', [NewsController::class, 'index'])->name('news.index');
Route::get('/tin-tuc/{news:slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/news/load-more', [NewsController::class, 'loadMore'])->name('news.load-more');
Route::get('/giai-phap', [SolutionController::class, 'index'])->name('solutions.index');
Route::get('/giai-phap/{slug}', [SolutionController::class, 'show'])->name('solutions.show');
Route::get('/san-pham', [ProductController::class, 'index'])->name('products.index');
Route::get('/san-pham/danh-muc/{category:slug}', [ProductController::class, 'productCategory'])->name('products.category');
Route::get('/san-pham/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/solutions/load-more', [SolutionController::class, 'loadMore'])->name('solutions.load-more');
Route::get('/du-an', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/du-an/{slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/load-more', [ProjectController::class, 'loadMore'])->name('projects.load-more');
Route::get('/lien-he', [HomeController::class, 'about'])->name('lien-he');
Route::post('/lien-he', [HomeController::class, 'contact'])->name('lien-he.store');