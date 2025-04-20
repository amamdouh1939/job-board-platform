<?php

namespace Modules\Company\Http\Controllers\API\V1;

use App\Helpers\DataResponse;
use App\Http\Controllers\Controller;
use Modules\Company\Services\CompanyService;

class DashboardController extends Controller
{
    protected CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function dashboard()
    {
        return DataResponse::data(
            $this->companyService->getDashboardData()
        )->status(200)
            ->message('Success')
            ->create();
    }
}
