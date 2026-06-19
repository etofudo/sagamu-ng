<?php

namespace App\Http\Controllers;

use App\Models\Neighbourhood;

class NeighbourhoodController extends Controller
{
    public function show(Neighbourhood $neighbourhood)
    {
        abort_unless($neighbourhood->is_published, 404);

        $listings = $neighbourhood->listings()->published()->take(6)->get();

        $otherNeighbourhoods = Neighbourhood::published()
            ->where('id', '!=', $neighbourhood->id)
            ->get();

        return view('pages.neighbourhood.show', compact('neighbourhood', 'listings', 'otherNeighbourhoods'));
    }
}
