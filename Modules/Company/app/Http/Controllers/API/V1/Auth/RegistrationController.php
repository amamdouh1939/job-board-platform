<?php

namespace Modules\Company\Http\Controllers\API\V1\Auth;

use App\Helpers\DataResponse;
use App\Http\Controllers\Controller;
use Modules\Company\Http\Requests\CompanyRegistrationRequest;
use Modules\Company\Services\CompanyService;
use Modules\Company\Transformers\CompanyResource;

class RegistrationController extends Controller
{
    protected CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function register(CompanyRegistrationRequest $request)
    {
        $data = $this->companyService->register($request->validated());
        return DataResponse::data(new CompanyResource($data))
            ->message('Created')
            ->status(201)
            ->create();
    }
}
