<?php

namespace Modules\Job\Repositories;

interface JobApplicationRepository
{
    public function create(array $data);

    public function getTotalNumberOfJobApplicationsForCompany(int $companyId);
}
