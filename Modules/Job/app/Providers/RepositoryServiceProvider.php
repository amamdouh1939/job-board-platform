<?php

namespace Modules\Job\Providers;

use Illuminate\Support\ServiceProvider;

use Modules\Job\Repositories\EloquentRepositories\JobRepository;
use Modules\Job\Repositories\JobRepository as JobRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    private array $repositories = [
        JobRepositoryInterface::class => JobRepository::class,
    ];

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        foreach ($this->repositories as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
