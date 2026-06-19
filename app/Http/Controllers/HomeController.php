<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Neighbourhood;

class HomeController extends Controller
{
    public function index()
    {
        $featuredArticle   = Article::published()->first();
        $recentArticles    = Article::published()->skip(1)->take(3)->get();
        $categories        = Category::active()->get();
        $eatDrinkListings  = Listing::published()
                                ->whereHas('category', fn($q) => $q->where('slug', 'restaurant-buka'))
                                ->take(3)->get();
        $recreationListings = Listing::published()
                                ->whereHas('category', fn($q) => $q->whereIn('slug', ['leisure-recreation', 'hotel-guesthouse']))
                                ->take(3)->get();
        $neighbourhoods    = Neighbourhood::published()->get();

        return view('pages.home', compact(
            'featuredArticle',
            'recentArticles',
            'categories',
            'eatDrinkListings',
            'recreationListings',
            'neighbourhoods'
        ));
    }
}
