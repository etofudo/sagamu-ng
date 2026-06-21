<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Neighbourhood;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $listings       = Listing::published()->latest('updated_at')->get(['slug', 'updated_at']);
        $articles       = Article::where('is_published', true)->latest('updated_at')->get(['slug', 'updated_at']);
        $categories     = Category::where('is_active', true)->get(['slug', 'updated_at']);
        $neighbourhoods = Neighbourhood::where('is_published', true)->get(['slug', 'updated_at']);

        $xml = view('sitemap', compact('listings', 'articles', 'categories', 'neighbourhoods'))->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
