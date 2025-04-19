<?php

namespace Modules\Candidate\Http\Controllers\API\V1\Auth;

use App\Helpers\DataResponse;
use App\Http\Controllers\Controller;
use Modules\Candidate\Http\Requests\CandidateRegistrationRequest;
use Modules\Candidate\Services\CandidateService;
use Modules\Candidate\Transformers\CandidateResource;

class RegistrationController extends Controller
{
    protected CandidateService $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function register(CandidateRegistrationRequest $request)
    {
        $data = $this->candidateService->register($request->validated());
        return DataResponse::data(new CandidateResource($data))
            ->status(201)
            ->message('Created')
            ->create();
    }
}
