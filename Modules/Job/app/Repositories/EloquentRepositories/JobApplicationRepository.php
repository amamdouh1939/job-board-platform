<?php

namespace Modules\Job\Repositories\EloquentRepositories;

use Modules\Job\Models\JobApplication;
use Modules\Job\Repositories\JobApplicationRepository as JobApplicationRepositoryInterface;

class JobApplicationRepository implements JobApplicationRepositoryInterface
{
    protected JobApplication $model;

    public function __construct(JobApplication $jobApplication)
    {
        $this->model = $jobApplication;
    }

    public function create(array $data)
    {
        return $this->model->query()
            ->create($data);
    }

    public function getTotalNumberOfJobApplicationsForCompany(int $companyId)
    {
        return $this->model->query()
            ->where('company_id', $companyId)
            ->count();
    }
}
