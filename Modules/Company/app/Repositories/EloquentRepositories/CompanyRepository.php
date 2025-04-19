<?php

namespace Modules\Company\Repositories\EloquentRepositories;

use Modules\Company\Models\Company;
use Modules\Company\Repositories\CompanyRepository as CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    protected Company $model;

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Company
    {
        return $this->model->query()->create($data);
    }
}
