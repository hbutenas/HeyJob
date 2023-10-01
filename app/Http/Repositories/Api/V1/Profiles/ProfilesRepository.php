<?php

namespace App\Http\Repositories\Api\V1\Profiles;

use App\Models\Profile;

class ProfilesRepository
{
  public function update(array $request, int $userId): int
  {
    return Profile::where('user_id', $userId)->update($request);
  }

  public function index(int $userId): object
  {
    return Profile::where('user_id', $userId)->first();
  }

  public function show(int $profileId): object
  {
    return Profile::where('id', $profileId)->first();
  }
}
