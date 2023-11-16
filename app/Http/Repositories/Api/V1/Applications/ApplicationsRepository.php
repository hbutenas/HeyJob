<?php

namespace App\Http\Repositories\Api\V1\Applications;

use App\Models\Application;

class ApplicationsRepository
{
  public function apply(int $jobId, int $userId): bool | object
  {
    return Application::firstOrCreate([
      'job_id' => $jobId,
      'user_id' => $userId
    ]);
  }

  public function index(int $userId): object
  {
    return Application::where('user_id', $userId)->with('job')->get(); // Might have issues later on if table contains X records, for this moment - OK
  }

  public function show(int $jobId)
  {
    return Application::where('job_id', $jobId)->first();
  }
}
