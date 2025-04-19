<?php

namespace Modules\Company\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Company\Repositories\CompanyRepository as CompanyRepositoryInterface;
use Modules\Company\Repositories\EloquentRepositories\CompanyRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    private array $repositories = [
        CompanyRepositoryInterface::class => CompanyRepository::class,
    ];

    /**
     * Register the service provider.
     */
    public function register(): void {
        foreach ($this->repositories as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
