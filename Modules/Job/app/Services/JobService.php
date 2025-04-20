<?php

namespace Modules\Job\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Modules\Job\Exceptions\DuplicateJobApplicationException;
use Modules\Job\Models\Job;
use Modules\Job\Models\JobApplication;
use Modules\Job\Repositories\JobApplicationRepository;
use Modules\Job\Repositories\JobRepository;
use Modules\Media\Jobs\ProcessMedia;

class JobService
{
    protected JobRepository $jobRepository;

    protected JobApplicationRepository $jobApplicationRepository;

    public function __construct(JobRepository $jobRepository, JobApplicationRepository $jobApplicationRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->jobApplicationRepository = $jobApplicationRepository;
    }

    public function index(?string $keyword = null, ?string $location = null, ?bool $isRemote, ?int $page = 1, ?int $size = 10): array
    {
        $data = $this->jobRepository->index($keyword, $location, $isRemote, $page, $size);
        return [
            'data' => $data->items(),
            'meta' => [
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'last_page' => $data->lastPage(),
            ]
        ];
    }

    public function create(array $data): Job
    {
        data_set($data, 'company_id', auth()->id());
        data_set($data, 'published_at', now()->toDateString());
        return $this->jobRepository->create($data);
    }

    public function update(Job $job, array $data): Job
    {
        return $this->jobRepository->update($job, $data);
    }

    public function delete(Job $job): void
    {
        $this->jobRepository->delete($job);
    }

    public function apply(Job $job, array $data): JobApplication
    {
        $job->load('company');
        $company = $job->company;
        $candidateAppliedBefore = (bool) $job->applications()->where('candidate_id', auth()->id());
        if ($candidateAppliedBefore) {
            throw new DuplicateJobApplicationException('You already applied to this job');
        }
        data_set($data, 'candidate_id', auth()->id());
        data_set($data, 'job_id', $job->id);
        data_set($data, 'company_id', $company->id);
        data_set($data, 'application_date', now()->toDateString());
        $jobApplication = $this->jobApplicationRepository->create(
            Arr::except($data, ['resume', 'cover_letter'])
        );

        $resume = data_get($data, 'resume');
        $resumePath = $resume->storePublicly('temp');

        $coverLetter = data_get($data, 'cover_letter');
        $coverLetterPath = $coverLetter->storePublicly('temp');

        dispatch(new ProcessMedia($jobApplication, $resumePath, 'resume'));
        dispatch(new ProcessMedia($jobApplication, $coverLetterPath, 'cover_letter'));

        return $jobApplication;
    }
}
