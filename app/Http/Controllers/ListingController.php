<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class ListingController extends Controller
{
    public function show(Listing $listing)
    {
        abort_unless($listing->is_published, 404);

        $relatedListings = Listing::published()
            ->where('category_id', $listing->category_id)
            ->where('id', '!=', $listing->id)
            ->take(3)
            ->get();

        return view('pages.listing.show', compact('listing', 'relatedListings'));
    }
}
