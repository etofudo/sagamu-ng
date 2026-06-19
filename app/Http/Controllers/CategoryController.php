<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Neighbourhood;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        abort_unless($category->is_active, 404);

        $query = $category->listings()->published();

        if ($neighbourhoodSlug = request('neighbourhood')) {
            $query->whereHas('neighbourhood', fn($q) => $q->where('slug', $neighbourhoodSlug));
        }

        $listings      = $query->paginate(12);
        $neighbourhoods = Neighbourhood::published()->get();

        return view('pages.category.show', compact('category', 'listings', 'neighbourhoods'));
    }
}
