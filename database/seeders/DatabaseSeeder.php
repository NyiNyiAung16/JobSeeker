<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Language;
use App\Models\Partner;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'NyiNyi',
            'email' => 'nyinyi@gmail.com',
            'password' => 'password123',
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'mgmg',
            'email' => 'mgmg@gmail.com',
            'password' => 'password123',
            'role' => 'employer'
        ]);
        User::factory()->create([
            'name' => 'susu',
            'email' => 'susu@gmail.com',
            'password' => 'password123',
            'role' => 'employee'
        ]);

        $this->call(JobSeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(JobTypeSeeder::class);
        $this->call(ContentSeeder::class);
    }
}
