<?php

namespace Modules\Job\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Job\Models\Job;

interface JobRepository
{
    public function index(?string $keyword = null, ?string $location = null, ?bool $isRemote, ?int $page = 1, ?int $size = 10): LengthAwarePaginator;

    public function create(array $data): Job;

    public function update(Job $job, array $data): Job;

    public function delete(Job $job): void;
}
