<?php

namespace Modules\Candidate\Repositories;

use Modules\Candidate\Models\Candidate;

interface CandidateRepository
{
    public function create(array $data): Candidate;
}
