<?php

namespace Modules\Candidate\Services;

use Modules\Candidate\Models\Candidate;
use Modules\Candidate\Repositories\CandidateRepository;

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
}
