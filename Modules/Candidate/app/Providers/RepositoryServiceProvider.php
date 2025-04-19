<?php

namespace Modules\Candidate\Providers;

use Illuminate\Support\ServiceProvider;

use Modules\Candidate\Repositories\CandidateRepository as CandidateRepositoryInterface;
use Modules\Candidate\Repositories\EloquentRepositories\CandidateRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    private array $repositories = [
        CandidateRepositoryInterface::class => CandidateRepository::class,
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
