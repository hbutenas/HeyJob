<?php

namespace App\Http\Services\Api\V1\Applications;

use App\Http\Repositories\Api\V1\Applications\ApplicationsRepository;
use App\Models\Application;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class ApplicationsService
{

  use HttpResponses;

  protected $applicationRepository;

  public function __construct(ApplicationsRepository $applicationsRepository)
  {
    $this->applicationRepository = $applicationsRepository;
  }

  /**
   * 1. Reikia pasiziuret kai jobs employer issifiltruoja, ar rodo aplikavusius same as below turbut tk kitas modelis tai daro
   * 2. Reikia, kad useris pamatytu savo aplikavusius darbus Auth::user()->applications()->with('job')->get();
   */


  public function apply(int $jobId): object
  {
    // TODO: For the future, make sure that user has a subscription or something, to apply more than X jobs per wk let's say
    // Receive the job_seeker(user) ID, who's trying to apply to job
    $userId = Auth::user()->id;

    // Tries to apply to the job if user didn't applied already
    $application = $this->applicationRepository->apply($jobId, $userId);

    // Validate the response
    if ($application->wasRecentlyCreated) { // Returns true if new record created, false if already existed
      return $this->successfullRequest($application, 'Successfully applied', 200);
    } else {
      return $this->failedRequest('', 'Already applied to the provided job', 400);
    }
  }

  public function index(): object
  {
    // Receive the job_seeker(user) ID, who's trying to fetch all his applications
    $userId = Auth::user()->id;

    // Fetch all applications
    $applications = $this->applicationRepository->index($userId);

    // Check the length of $applications, maybe user didn't applied yet
    if (sizeof($applications) <= 0) {
      return $this->successfullRequest('', 'There are nothing to load... Apply first', 200);
    } else {
      return $this->successfullRequest($applications, 'Successfully loaded applications', 200);
    }
  }

  /**
   * TODO
   * Needs to return a normal HttpResponse
   * ! show method - NOT TESTED
   */
  public function show(int $jobId)
  {
    return $this->applicationRepository->show($jobId);
  }
}
