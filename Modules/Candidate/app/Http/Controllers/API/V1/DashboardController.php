<?php

namespace Modules\Candidate\Http\Controllers\API\V1;

use App\Helpers\DataResponse;
use App\Http\Controllers\Controller;
use Modules\Candidate\Services\CandidateService;

class DashboardController extends Controller
{
    protected CandidateService $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function dashboard()
    {
        return DataResponse::data(
            $this->candidateService->getDashboardData()
        )->status(200)
            ->message('Success')
            ->create();
    }
}
