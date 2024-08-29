<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobCategories = [
            'Accounting',
            'Administrative',
            'Advertising',
            'Agriculture',
            'Architecture',
            'Arts',
            'Banking',
            'Biotechnology',
            'Business',
            'Communications',
            'Construction',
            'Consulting',
            'Customer Service',
            'Design',
            'Education',
            'Engineering',
            'Entertainment',
            'Environmental',
            'Finance',
            'Healthcare',
            'Hospitality',
            'Human Resources',
            'Information Technology',
            'Logistics',
            'Manufacturing',
            'Pharmaceutical',
            'Public Relations',
            'Real Estate',
            'Retail',
            'Sales',
        ];

        foreach ($jobCategories as $category) {
            DB::table('categories')->insert([
                'type' => $category,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
