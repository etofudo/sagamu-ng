<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NeighbourhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $neighbourhoods = [
            [
                'name'             => 'Makun Sagamu',
                'character'        => 'Commercial & Residential',
                'rental_range'     => '₦300k – ₦800k / yr',
                'best_for'         => 'Professionals & Families',
                'nearest_landmark' => 'Sagamu Interchange',
                'transport_info'   => 'Good Lagos connections',
                'description'      => '<p>Makun is where Sagamu is growing. The stretch of land running along the expressway corridor from the interchange toward Makun junction has seen more new construction, new businesses, and new arrivals in the last five years than any other part of the LGA.</p>',
                'is_published'     => true,
            ],
            [
                'name'             => 'Isale Sagamu',
                'character'        => 'Historic Town Centre',
                'rental_range'     => '₦150k – ₦400k / yr',
                'best_for'         => 'Long-term Residents',
                'nearest_landmark' => 'Akarigbo Palace',
                'transport_info'   => 'Central, well-connected',
                'description'      => '<p>Isale Sagamu is the historic heart of the town. More affordable, more character, more community. Excellent for those who want to feel embedded in the town rather than adjacent to it.</p>',
                'is_published'     => true,
            ],
            [
                'name'             => 'Agbowa',
                'character'        => 'Residential',
                'rental_range'     => '₦120k – ₦350k / yr',
                'best_for'         => 'Families',
                'nearest_landmark' => 'Agbowa Junction',
                'transport_info'   => 'Buses to town centre',
                'description'      => '<p>Agbowa is a residential area with established housing stock and quieter streets. Good for families who prioritise space and stability.</p>',
                'is_published'     => true,
            ],
            [
                'name'             => 'Ijoku',
                'character'        => 'Residential',
                'rental_range'     => '₦100k – ₦300k / yr',
                'best_for'         => 'Families',
                'nearest_landmark' => 'Ijoku Road',
                'transport_info'   => 'Buses to town centre',
                'description'      => '<p>Ijoku offers quiet residential living with strong community ties. Affordable housing stock and good access to the town centre.</p>',
                'is_published'     => true,
            ],
        ];

        foreach ($neighbourhoods as $n) {
            \App\Models\Neighbourhood::updateOrCreate(
                ['slug' => Str::slug($n['name'])],
                array_merge($n, ['slug' => Str::slug($n['name'])])
            );
        }
    }
}
