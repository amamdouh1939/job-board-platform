<?php

namespace Modules\Company\Repositories;

use Modules\Company\Models\Company;

interface CompanyRepository
{
    public function create(array $data): Company;
}
