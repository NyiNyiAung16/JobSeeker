<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            ['name' => 'Abstract', 'image_url' => '/storage/partners/abstract.avif'],
            ['name' => 'Brand Company', 'image_url' => '/storage/partners/brandCompany.avif'],
            ['name' => 'Color Connect', 'image_url' => '/storage/partners/colorConnect.avif'],
            ['name' => 'Culture Arrow', 'image_url' => '/storage/partners/cultureArrow.avif'],
            ['name' => 'Culture Logo', 'image_url' => '/storage/partners/cultureLogo.avif'],
            ['name' => 'Social Net', 'image_url' => '/storage/partners/socialNet.avif']
        ];

        foreach ($partners as $partner) {
            DB::table('partners')->insert([
                'name' => $partner['name'],
                'image_url' => $partner['image_url'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
