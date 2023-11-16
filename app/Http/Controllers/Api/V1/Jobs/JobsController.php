<?php

namespace App\Http\Controllers\Api\V1\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Jobs\CreateJobRequest;
use App\Http\Requests\Api\V1\Jobs\DeleteJobRequest;
use App\Http\Requests\Api\V1\Jobs\ShowJobRequest;
use App\Http\Requests\Api\V1\Jobs\UpdateJobRequest;
use App\Http\Services\Api\V1\Jobs\JobsService;

class JobsController extends Controller
{

    protected $jobsService;

    public function __construct(JobsService $jobsService)
    {
        $this->jobsService = $jobsService;
    }

    public function store(CreateJobRequest $request): object
    {
        return $this->jobsService->store($request);
    }

    public function index(): object
    {
        return $this->jobsService->index();
    }

    public function show(ShowJobRequest $request): object
    {
        return $this->jobsService->show((int)$request->id);
    }

    public function update(UpdateJobRequest $request): object
    {
        return $this->jobsService->update((int)$request->id, $request);
    }

    public function destroy(DeleteJobRequest $request): object
    {
        return $this->jobsService->destroy((int)$request->id);
    }
}
