<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingUpgradeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NeighbourhoodController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\SitemapController;

Route::get('/',                                   [HomeController::class, 'index'])->name('home');
Route::get('/article/{article:slug}',             [ArticleController::class, 'show'])->name('article.show');
Route::get('/listing/{listing:slug}',             [ListingController::class, 'show'])->name('listing.show');
Route::get('/category/{category:slug}',           [CategoryController::class, 'show'])->name('category.show');
Route::get('/neighbourhood/{neighbourhood:slug}', [NeighbourhoodController::class, 'show'])->name('neighbourhood.show');
Route::get('/list-your-business',                 [PageController::class, 'listBusiness'])->name('list-business');
Route::post('/list-your-business',                [PageController::class, 'submitBusiness'])->name('list-business.submit');
Route::get('/new-to-sagamu',                      [PageController::class, 'newToSagamu'])->name('new-to-sagamu');

// Featured listing upgrade (payment)
Route::get('/listing/{listing:slug}/upgrade',          [ListingUpgradeController::class, 'show'])->name('listing.upgrade');
Route::post('/listing/{listing:slug}/upgrade',         [ListingUpgradeController::class, 'initiate'])->name('listing.upgrade.initiate');
Route::get('/listing/{listing:slug}/upgrade/callback', [ListingUpgradeController::class, 'callback'])->name('listing.upgrade.callback');

// Donate
Route::get('/support-sagamu',          [DonateController::class, 'show'])->name('donate');
Route::post('/support-sagamu',         [DonateController::class, 'initiate'])->name('donate.initiate');
Route::get('/support-sagamu/thank-you',[DonateController::class, 'callback'])->name('donate.callback');

// SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
