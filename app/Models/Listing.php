<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Listing extends Model
{
    use HasSlug;

    protected $fillable = [
        'name', 'slug', 'category_id', 'neighbourhood_id',
        'description', 'address', 'phone', 'whatsapp',
        'opening_hours', 'price_range', 'website',
        'hero_image', 'gallery', 'is_featured', 'is_published',
        'status', 'contact_name', 'contact_email',
    ];

    protected $casts = [
        'gallery'      => 'array',
        'is_featured'  => 'boolean',
        'is_published' => 'boolean',
    ];

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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function neighbourhood(): BelongsTo
    {
        return $this->belongsTo(Neighbourhood::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getPriceSymbolAttribute(): string
    {
        return match ($this->price_range) {
            'budget'  => '₦',
            'mid'     => '₦₦',
            'premium' => '₦₦₦',
            default   => '',
        };
    }
}
