<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobTypes = [
            'Full-Time',
            'Part-Time',
            'Contract',
            'Temporary',
            'Internship',
            'Freelance',
            'Seasonal',
            'Volunteer'
        ];

        foreach ($jobTypes as $type) {
            DB::table('job_types')->insert([
                'name' => $type,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
