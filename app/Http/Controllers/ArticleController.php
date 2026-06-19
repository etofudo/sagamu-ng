<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        abort_unless($article->is_published, 404);

        $moreArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->take(3)
            ->get();

        return view('pages.article.show', compact('article', 'moreArticles'));
    }
}
