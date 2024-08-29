<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locationNames = [
            'New York City, United States',
            'Tokyo, Japan',
            'London, United Kingdom',
            'Paris, France',
            'Sydney, Australia',
            'Berlin, Germany',
            'Toronto, Canada',
            'Mumbai, India',
            'São Paulo, Brazil',
            'Cairo, Egypt',
            'Beijing, China',
            'Moscow, Russia',
            'Johannesburg, South Africa',
            'Dubai, United Arab Emirates',
            'Mexico City, Mexico',
            'Buenos Aires, Argentina',
            'Bangkok, Thailand',
            'Istanbul, Turkey',
            'Seoul, South Korea',
            'Madrid, Spain',
            'Rome, Italy',
            'Jakarta, Indonesia',
            'Nairobi, Kenya',
            'Lima, Peru',
            'Los Angeles, United States',
            'Vancouver, Canada',
            'Amsterdam, Netherlands',
            'Warsaw, Poland',
            'Athens, Greece',
            'Singapore, Singapore'
        ];
        
        foreach ($locationNames as $name) {
            DB::table('locations')->insert([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
