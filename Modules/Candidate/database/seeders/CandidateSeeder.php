<?php

namespace Modules\Candidate\Database\Seeders;


use Illuminate\Database\Seeder;
use Modules\Candidate\Models\Candidate;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candidate::factory(20)->create();
    }
}
