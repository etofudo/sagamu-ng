<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Restaurant / Buka',        'icon' => 'heroicon-o-cake',           'sort_order' => 1],
            ['name' => 'Bar & Grill',               'icon' => 'heroicon-o-fire',            'sort_order' => 2],
            ['name' => 'Street Food',               'icon' => 'heroicon-o-shopping-bag',    'sort_order' => 3],
            ['name' => 'Supermarket / Shop',        'icon' => 'heroicon-o-building-storefront', 'sort_order' => 4],
            ['name' => 'Pharmacy / Clinic',         'icon' => 'heroicon-o-heart',           'sort_order' => 5],
            ['name' => 'School',                    'icon' => 'heroicon-o-academic-cap',    'sort_order' => 6],
            ['name' => 'Gym / Recreation',          'icon' => 'heroicon-o-trophy',          'sort_order' => 7],
            ['name' => 'Hotel / Guesthouse',        'icon' => 'heroicon-o-home',            'sort_order' => 8],
            ['name' => 'Logistics / Haulage',       'icon' => 'heroicon-o-truck',           'sort_order' => 9],
            ['name' => 'Real Estate / Property',    'icon' => 'heroicon-o-building-office', 'sort_order' => 10],
            ['name' => 'Financial Services',        'icon' => 'heroicon-o-banknotes',       'sort_order' => 11],
            ['name' => 'Professional Services',     'icon' => 'heroicon-o-briefcase',       'sort_order' => 12],
            ['name' => 'Manufacturing / Industrial','icon' => 'heroicon-o-cog-6-tooth',     'sort_order' => 13],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name'       => $cat['name'],
                    'slug'       => Str::slug($cat['name']),
                    'icon'       => $cat['icon'],
                    'sort_order' => $cat['sort_order'],
                    'is_active'  => true,
                ]
            );
        }
    }
}
