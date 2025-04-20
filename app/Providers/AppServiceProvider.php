<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Hashing\HashManager;
use Illuminate\Support\ServiceProvider;
use Modules\Candidate\Models\Candidate;
use Modules\Company\Models\Company;
use Modules\Job\Models\Job;
use Modules\Job\Models\JobApplication;
use Modules\Media\Models\Media;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('hash', function ($app) {
            return new HashManager($app);
        });

        $this->app->singleton('hash.driver', function ($app) {
            return $app['hash']->driver();
        });

        $this->app->singleton(Hasher::class, function ($app) {
            return $app['hash.driver'];
        });


        Relation::enforceMorphMap([
            'candidate' => Candidate::class,
            'company' => Company::class,
            'job' => Job::class,
            'media' => Media::class,
            'job_application' => JobApplication::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
