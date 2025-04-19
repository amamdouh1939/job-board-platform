<?php

namespace Modules\Candidate\Repositories\EloquentRepositories;

use Modules\Candidate\Models\Candidate;
use Modules\Candidate\Repositories\CandidateRepository as CandidateRepositoryInterface;

class CandidateRepository implements CandidateRepositoryInterface
{
    protected Candidate $model;

    public function __construct(Candidate $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Candidate
    {
        return $this->model->query()->create($data);
    }
}
