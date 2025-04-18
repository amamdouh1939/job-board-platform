<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Candidate\Database\Seeders\CandidateDatabaseSeeder;
use Modules\Candidate\Database\Seeders\CandidateSeeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CandidateDatabaseSeeder::class,
        ]);
    }
}
