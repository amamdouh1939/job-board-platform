<?php

namespace Modules\Job\Repositories\EloquentRepositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Candidate\Models\Candidate;
use Modules\Company\Models\Company;
use Modules\Job\Models\Job;
use Modules\Job\Repositories\JobRepository as JobRepositoryInterface;

class JobRepository implements JobRepositoryInterface
{
    protected Job $model;

    public function __construct(Job $model)
    {
        $this->model = $model;
    }

    public function index(?string $keyword = null, ?string $location = null, ?bool $isRemote, ?int $page = 1, ?int $size = 10): LengthAwarePaginator
    {
        return match (get_class(auth()->user())) {
            Candidate::class => $this->listForCandidates($keyword, $location, $isRemote, $page, $size),
            Company::class => $this->listForCompanies($page, $size)
        };
    }


    public function create(array $data): Job
    {
        return $this->model->query()->create($data);
    }

    public function update(Job $job, array $data): Job
    {
        $job->update($data);
        return $job;
    }

    public function delete(Job $job): void
    {
        $job->delete();
    }

    private function listForCandidates(?string $keyword = null, ?string $location, ?bool $isRemote, ?int $page, ?int $size)
    {
        $cacheKey = $this->generateCacheKey($keyword, $location, $isRemote, $page, $size);
        return Cache::remember($cacheKey, 5 * 60, function () use ($keyword, $location, $isRemote, $page, $size) {
            $query = $this->model->query()->with('company');
            if ($keyword) {
                $query->where(function (Builder $query) use ($keyword) {
                    $query->where('title', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('description', 'LIKE', '%' . $keyword . '%');
                });
            }

            if ($location) {
                $query->where('location', 'LIKE', '%' . $location . '%');
            }

            if (! is_null($isRemote)) {
                $query->where('is_remote', $isRemote);
            }

            return $query->paginate($size, page: $page);
        });
    }

    private function generateCacheKey(?string $keyword, ?string $location, ?string $isRemote, ?int $page, ?int $size)
    {
        $cacheKey = 'jobs';
        if ($keyword) {
            $cacheKey .= ':keyword=' . $keyword . ':';
        }

        if ($location) {
            $cacheKey .= ':location=' . $location . ':';
        }

        if (! is_null($isRemote)) {
            $cacheKey .= ':is_remote=' . $isRemote . ':';
        }

        if ($size) {
            $cacheKey .= ':size=' . $size . ';';
        }

        if ($page) {
            $cacheKey .= ':page=' . $page;
        }

        return $cacheKey;
    }

    private function listForCompanies(?int $page, ?int $size): LengthAwarePaginator
    {
        return $this->model->query()
            ->with('company')
            ->paginate($size, page: $page);
    }

    public function getNumberOfJobPostsByCompanyId(int $companyId): int
    {
        return $this->model->query()
            ->where('company_id', $companyId)
            ->count();
    }
}
