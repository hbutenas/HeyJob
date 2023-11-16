<?php

namespace App\Http\Repositories\Api\V1\Companies;

use App\Models\Company;

class CompaniesRepository
{
  public function update(array $request, int $userId): int
  {
    return Company::where('user_id', $userId)->update($request);
  }

  public function index(int $userId): object
  {
    return Company::where('user_id', $userId)->first();
  }

  public function show(int $companyId): object
  {
    return Company::where('id', $companyId)->first();
  }
}
