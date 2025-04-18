<?php

namespace Modules\Candidate\Database\Seeders;

use Illuminate\Database\Seeder;

class CandidateDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call([
             CandidateSeeder::class,
         ]);
    }
}
