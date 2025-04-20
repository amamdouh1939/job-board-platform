<?php

namespace Modules\Job\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Candidate\Models\Candidate;
use Modules\Company\Models\Company;
use Modules\Job\Models\Job;

class JobPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    public function create(Candidate|Company $user)
    {
        if ($user instanceof Company) {
            return true;
        }

        return false;
    }

    public function view(Candidate|Company $user, Job $job)
    {
        if ($user instanceof Company) {
            return $job->company->is($user);
        }

        return true;
    }

    public function update(Candidate|Company $user, Job $job)
    {
        if ($user instanceof Company) {
            return $job->company->is($user);
        }

        return false;
    }

    public function delete(Candidate|Company $user, Job $job)
    {
        if ($user instanceof Company) {
            return $job->company->is($user);
        }

        return false;
    }
}
