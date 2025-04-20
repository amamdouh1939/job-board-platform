<?php

namespace Modules\Job\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Job\Models\Job;
use Modules\Job\Repositories\JobRepository;

class JobService
{
    protected JobRepository $jobRepository;

    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function index(?string $keyword = null, ?string $location = null, ?bool $isRemote, ?int $page = 1, ?int $size = 10): array
    {
        $data = $this->jobRepository->index($keyword, $location, $isRemote, $page, $size);
        return [
            'data' => $data->items(),
            'meta' => [
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'last_page' => $data->lastPage(),
            ]
        ];
    }

    public function create(array $data): Job
    {
        data_set($data, 'company_id', auth()->id());
        data_set($data, 'published_at', now()->toDateString());
        return $this->jobRepository->create($data);
    }

    public function update(Job $job, array $data): Job
    {
        return $this->jobRepository->update($job, $data);
    }

    public function delete(Job $job): void
    {
        $this->jobRepository->delete($job);
    }
}
