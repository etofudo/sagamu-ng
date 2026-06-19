<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Neighbourhood extends Model
{
    use HasSlug;

    protected $fillable = [
        'name', 'slug', 'character', 'rental_range', 'best_for',
        'nearest_landmark', 'transport_info', 'description',
        'hero_image', 'is_published',
    ];

    protected $casts = ['is_published' => 'boolean'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
