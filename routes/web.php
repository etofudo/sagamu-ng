<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NeighbourhoodController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController;

Route::get('/',                                   [HomeController::class, 'index'])->name('home');
Route::get('/article/{article:slug}',             [ArticleController::class, 'show'])->name('article.show');
Route::get('/listing/{listing:slug}',             [ListingController::class, 'show'])->name('listing.show');
Route::get('/category/{category:slug}',           [CategoryController::class, 'show'])->name('category.show');
Route::get('/neighbourhood/{neighbourhood:slug}', [NeighbourhoodController::class, 'show'])->name('neighbourhood.show');
Route::get('/list-your-business',                 [PageController::class, 'listBusiness'])->name('list-business');
Route::post('/list-your-business',                [PageController::class, 'submitBusiness'])->name('list-business.submit');
Route::get('/new-to-sagamu',                      [PageController::class, 'newToSagamu'])->name('new-to-sagamu');
