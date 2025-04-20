<?php

namespace Modules\Candidate\Services;

use Modules\Candidate\Models\Candidate;
use Modules\Candidate\Repositories\CandidateRepository;
use Modules\Job\Transformers\JobApplicationResource;

class CandidateService
{
    protected CandidateRepository $candidateRepository;

    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    public function register(array $data): Candidate
    {
        return $this->candidateRepository->create($data);
    }

    public function getDashboardData()
    {
        $candidate = auth()->user();
        $applications = $candidate->applications()->with('job.company')->get();
        return [
            'total_number_of_applications' => $applications->count(),
            'applications' => JobApplicationResource::collection($applications),
        ];
    }
}
