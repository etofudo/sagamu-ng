<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
use App\Models\Neighbourhood;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function listBusiness()
    {
        $categories     = Category::active()->get();
        $neighbourhoods = Neighbourhood::orderBy('name')->get();

        return view('pages.list-business', compact('categories', 'neighbourhoods'));
    }

    public function submitBusiness(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:200',
            'category'      => 'required|string|max:100',
            'neighbourhood' => 'required|string|max:100',
            'description'   => 'required|string|min:60',
            'address'       => 'required|string|max:300',
            'phone'         => 'required|string|max:30',
            'whatsapp'      => 'nullable|string|max:30',
            'opening_hours' => 'nullable|string|max:100',
            'price_range'   => 'nullable|in:budget,mid,premium,na',
            'website'       => 'nullable|url|max:300',
            'contact_name'  => 'nullable|string|max:100',
            'contact_email' => 'nullable|email|max:200',
        ]);

        // Resolve category and neighbourhood IDs if they exist, otherwise store name only
        $category      = Category::where('name', $validated['category'])->first();
        $neighbourhood = Neighbourhood::where('name', $validated['neighbourhood'])->first();

        Listing::create([
            'name'             => $validated['name'],
            'category_id'      => $category?->id ?? Category::first()->id,
            'neighbourhood_id' => $neighbourhood?->id,
            'description'      => $validated['description'],
            'address'          => $validated['address'],
            'phone'            => $validated['phone'],
            'whatsapp'         => $validated['whatsapp'] ?? null,
            'opening_hours'    => $validated['opening_hours'] ?? null,
            'price_range'      => $validated['price_range'] ?? null,
            'website'          => $validated['website'] ?? null,
            'contact_name'     => $validated['contact_name'] ?? null,
            'contact_email'    => $validated['contact_email'] ?? null,
            'status'           => 'pending',
            'is_published'     => false,
        ]);

        return redirect()->route('list-business')
            ->with('success', 'Thank you! Your listing has been submitted and will be reviewed within 48 hours.');
    }

    public function newToSagamu()
    {
        return view('pages.new-to-sagamu');
    }
}
