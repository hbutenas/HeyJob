<?php

namespace App\Http\Repositories\Api\V1\Jobs;

use App\Models\Job;

class JobsRepository
{

  public function store(object $request): object
  {
    return  Job::create([
      'title' => $request->title,
      'description' => $request->description,
      'salary' => (int)$request->salary,
      'location' => $request->location,
      'application_deadline' => $request->application_deadline,
      'category_id' => $request->category_id,
      'company_id' => $request->company_id
    ]);
  }

  public function index(): object
  {
    return Job::with(['company', 'category'])->get();
  }

  public function show(int $jobId): object
  {
    return Job::where('id', $jobId)->with(['company', 'category'])->first();
  }

  public function update(int $jobId, array $request): int
  {
    return Job::where('id', $jobId)->update($request);
  }

  public function destroy(int $jobId): int
  {
    return Job::where('id', $jobId)->delete();
  }
}
