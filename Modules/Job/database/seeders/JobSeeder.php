<?php

namespace Modules\Job\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Job\Models\Job;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Job::factory(30)->create();
    }
}
