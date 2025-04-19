<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Artisan::call('passport:client', [
            '--provider' => 'candidates',
            '--name' => 'Candidates client',
            '--password' => true,
        ]);
        Artisan::call('passport:client', [
            '--provider' => 'companies',
            '--name' => 'Companies client',
            '--password' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
