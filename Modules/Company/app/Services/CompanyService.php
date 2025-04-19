<?php

namespace Modules\Company\Services;

use Modules\Company\Models\Company;
use Modules\Company\Repositories\CompanyRepository;

class CompanyService
{
    protected CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function register(array $data): Company
    {
        return $this->companyRepository->create($data);
    }
}
