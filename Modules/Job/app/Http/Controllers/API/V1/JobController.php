<?php

namespace Modules\Job\Http\Controllers\API\V1;

use App\Helpers\DataResponse;
use App\Http\Controllers\Controller;
use Modules\Job\Http\Requests\CreateJobRequest;
use Modules\Job\Http\Requests\JobApplicationRequest;
use Modules\Job\Http\Requests\ListJobRequest;
use Modules\Job\Http\Requests\UpdateJobRequest;
use Modules\Job\Models\Job;
use Modules\Job\Services\JobService;
use Modules\Job\Transformers\JobResource;

class JobController extends Controller
{
    protected JobService $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    public function index(ListJobRequest $request)
    {
        $res = $this->jobService->index(
            $request->query('keyword'),
            $request->query('location'),
            $request->query('is_remote'),
            $request->query('page'),
            $request->query('size')
        );

        return DataResponse::data(
            JobResource::collection(data_get($res, 'data'))
        )
            ->meta(data_get($res, 'meta'))
            ->status(200)
            ->message('Success')
            ->create();
    }


    public function store(CreateJobRequest $request)
    {
        $data = $this->jobService->create($request->validated());
        return DataResponse::data(
            new JobResource($data)
        )->status(201)
            ->message('Created')
            ->create();
    }


    public function show(Job $job)
    {
        return DataResponse::data(new JobResource($job))
            ->status(200)
            ->message('Success')
            ->create();
    }

    public function update(Job $job, UpdateJobRequest $request) {
        $data = $this->jobService->update($job, $request->validated());
        return DataResponse::data(
            new JobResource($data)
        )->status(200)
            ->message('Success')
            ->create();
    }

    public function destroy(Job $job) {
        $this->jobService->delete($job);
        DataResponse::data(null)
            ->status(204)
            ->message('No content')
            ->create();
    }

    public function apply(Job $job, JobApplicationRequest $request)
    {
        $this->jobService->apply($job, $request->validated());
        return DataResponse::data(null)
            ->status(201)
            ->message('Application submitted successfully')
            ->create();
    }
}
