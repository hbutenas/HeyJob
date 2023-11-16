<?php

namespace App\Http\Services\Api\V1\Jobs;

use App\Http\Repositories\Api\V1\Jobs\JobsRepository;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JobsService
{
  use HttpResponses;

  protected $jobsRepository;

  public function __construct(JobsRepository $jobsRepository)
  {
    $this->jobsRepository = $jobsRepository;
  }

  public function store(object $request): object
  {
    // Receive the company who's trying to create new job
    $company = Auth::user()->company;

    // TODO Check if user has a premium/subscribtion to set the deadline for a longer period than 7 days

    // Set company id in the request object
    $request['company_id'] = $company->id;

    // Set the default expiration date from now to 7 days // Will be updated when the subscription system starts working
    $request['application_deadline'] = Carbon::now()->addDays(7)->setTime(23, 59, 59)->format('Y-m-d H:i:s');

    $job = $this->jobsRepository->store($request);


    if (!$job) {
      return $this->failedRequest('', 'Failed to create new job', 400);
    }

    return $this->successfullRequest($job, 'Job successfully created', 201);
  }

  public function index(): object
  {
    // Receive the list of jobs
    $jobs = $this->jobsRepository->index();

    // If there are no jobs return only message
    if (sizeof($jobs) <= 0) {
      return $this->successfullRequest('', 'Currently there are no jobs available', 200);
    }

    return $this->successfullRequest($jobs, 'Jobs successfully loaded', 200);
  }

  /**
   * TODO 
   * Needs to return a normal HttpResponse
   */
  public function show(int $jobId): object
  {
    return $this->jobsRepository->show($jobId);
  }

  public function update(int $jobId, object $request): object
  {
    // Get company id who's trying to update job
    $companyId = Auth::user()->company->id;

    // Get job which has to be updated
    $job = $this->jobsRepository->show($jobId);

    /**
     * There is no need to validate $job value because:
     * UpdateJobRequest will check if the provided ID exists in table before sending it to JobsController.php
     */

    // If the job does not belong to this company throw error
    if ($job->company_id !== $companyId) {
      return $this->failedRequest('', 'Job ad does not belong to your company', 400);
    }

    // TODO later on check if company subscription allows user to change end date of ad 

    // Set values for updated job
    $jobFields = [
      'title' => $request->title ? $request->title : $job->title,
      'description' => $request->description ? $request->description : $job->description,
      'location' => $request->location ? $request->location : $job->location,
      'salary' => $request->salary ? $request->salary : $job->salary,
      'category_id' => $request->category_id ? $request->category_id : $job->category_id
    ];

    // Update job 
    $updatedJob = $this->jobsRepository->update($jobId, $jobFields);

    // Failed to update the job ad
    if (!$updatedJob) {
      return $this->failedRequest('', 'Failed to update job ad. Try again later...', 400);
    }

    return $this->successfullRequest('', 'Successfully updated job ad', 200);
  }

  public function destroy(int $jobId): object
  {
    // Get company id who's trying to delete job
    $companyId = Auth::user()->company->id;

    // Get job which has to be deleted
    $job = $this->jobsRepository->show($jobId);

    // If the job does not belong to this company throw error
    if ($job->company_id !== $companyId) {
      return $this->failedRequest('', 'Job ad does not belong to your company', 400);
    }

    // Delete job ad
    $deletedJob = $this->jobsRepository->destroy($jobId);

    // Failed to delete the job ad
    if (!$deletedJob) {
      return $this->failedRequest('', 'Failed to delete job ad. Try again later...', 400);
    }

    return $this->successfullRequest('', 'Job ad successfully deleted', 200);
  }
}
