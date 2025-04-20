<?php

namespace Modules\Company\Services;

use Modules\Company\Models\Company;
use Modules\Company\Repositories\CompanyRepository;
use Modules\Job\Repositories\JobApplicationRepository;
use Modules\Job\Repositories\JobRepository;

class CompanyService
{
    protected CompanyRepository $companyRepository;

    protected JobRepository $jobRepository;

    protected JobApplicationRepository $jobApplicationRepository;

    public function __construct(CompanyRepository $companyRepository, JobRepository $jobRepository, JobApplicationRepository $jobApplicationRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->jobRepository = $jobRepository;
        $this->jobApplicationRepository = $jobApplicationRepository;
    }

    public function register(array $data): Company
    {
        return $this->companyRepository->create($data);
    }

    public function getDashboardData()
    {
        return [
            'number_of_job_posts' => $this->jobRepository->getNumberOfJobPostsByCompanyId(auth()->id()),
            'total_applications_received' => $this->jobApplicationRepository->getTotalNumberOfJobApplicationsForCompany(auth()->id())
        ];
    }
}
